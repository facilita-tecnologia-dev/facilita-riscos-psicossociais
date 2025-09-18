<?php

namespace App\Http\Controllers\Private;

use App\Enums\UserStatusTypes;
use App\Enums\GenderEnum;
use App\Enums\RoleEnum;
use App\Helpers\SessionErrorHelper;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Company;
use App\Models\Permission;
use App\Models\RolePermission;
use App\Models\User;
use App\Models\UserCustomPermission;
use App\Models\UserDepartmentPermission;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Services\User\UserFilterService;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password as FacadePassword;
use Illuminate\Validation\Rules\Password;

class UserController
{
    protected UserFilterService $filterService;
    protected UserRepository $userRepository;

    protected $companyCustomTests;

    protected $defaultTests;

    public function __construct(UserFilterService $filterService, UserRepository $userRepository)
    {
        $this->filterService = $filterService;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        Gate::authorize('user-index');

        $latestPsychosocialCampaign = session('auth:company')->latestPsychosocialCampaign();
        $latestOrganizationalCampaign = session('auth:company')->latestOrganizationalCampaign();

        // $query = session('auth:company')->users()->getQuery();
        // $users = $this->filterService->sort($this->filterService->apply($query))
        // ->with(['collections'])
        // ->paginate(15)
        // ->appends(request()->query());
        
        $users = session('auth:company')->users() 
        ->with(['collections'])
        ->paginate(15)
        ->appends(request()->query());

        $filters = collect(request()->query())->except(['order_by', 'order_direction'])->filter(fn ($value) => $value !== null);

        return view('private.user.index', [
            'users' => $users,
            'latestPsychosocialCampaign' => $latestPsychosocialCampaign,
            'latestOrganizationalCampaign' => $latestOrganizationalCampaign,
            'filters' => $filters,
        ]);
    }

    public function create()
    {
        Gate::authorize('user-create');

        $roles = array_map(fn($role) => ['option' => $role->label(), 'value' => $role->value], RoleEnum::cases());

        return view('private.user.create', compact('roles'));
    }

    public function store(UserStoreRequest $request)
    {
        Gate::authorize('user-create');

        $user = $this->userRepository->store($request->safe());

        if($user->hasRole('manager')){
            return to_route('user.department-scope', $user)->with('message', 'Perfil do colaborador criado com sucesso!');
        }

        return to_route('user.show', $user)->with('message', 'Perfil do colaborador criado com sucesso!');
    }

    public function show(User $user)
    {
        Gate::authorize('user-show');

        $latestOrganizationalClimateCollectionDate = $user['latestPsychosocialCollection']?->created_at->diffForHumans() ?? 'Nunca';
        $latestPsychosocialCollectionDate = $user['latestPsychosocialCollection']?->created_at->diffForHumans() ?? 'Nunca';

        return view('private.user.show', compact(
            'user', 
            'latestPsychosocialCollectionDate', 
            'latestOrganizationalClimateCollectionDate', 
        ));
    }

    public function edit(User $user)
    {
        Gate::authorize('user-edit');

        $status = array_map(fn (UserStatusTypes $status) => ['option' => UserStatusTypes::labelFromValue($status->value), 'value' => $status->value], UserStatusTypes::cases());
        $roles = array_map(fn($role) => ['option' => $role->label(), 'value' => $role->value], RoleEnum::cases());

        return view('private.user.update', compact(
            'user',
            'roles',
            'status',
        ));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        Gate::authorize('user-edit');

        $this->userRepository->update($request->safe(), $user);

        return to_route('user.show', $user)->with('message', 'Perfil do colaborador atualizado com sucesso!');
    }

    public function destroy(User $user)
    {
        Gate::authorize('user-delete');

        $this->userRepository->destroy($user);

        return to_route('user.index')->with('message', 'Perfil do colaborador excluído com sucesso!');
    }

    public function showImport()
    {
        return view('private.user.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_users' => 'required|file|mimes:xlsx|max:1024',
        ]);

        $importUsers = $this->userRepository->import($request);

        if($importUsers instanceof Collection){
            $importUsers = $importUsers->map(function($validationError){
                $username = $validationError->values()['nome_completo'] ?? 'Nome do colaborador ausente';
                $nameBagFormatted = str_replace('_', ' ', $validationError->errors()[0]);
                return "Linha " . $validationError->row() . " - " . $username . ' - ' . $nameBagFormatted;
            });

            return view('private.user.import', [
                'failures' => $importUsers,
            ]);
        }

        return back()->with('message', 'Usuários importados com sucesso');
    }

    public function showPermissions(User $user)
    {
        Gate::authorize('user-permission-edit');

        $defaultPermissions = RolePermission::where('role_id', $user->roles[0]->id)
            ->with('permission')
            ->orderBy('allowed', 'desc')
            ->get();

        $customizedPermissions = UserCustomPermission::where('user_id', $user->id)
            ->with('permission')
            ->where('company_id', session('auth:company')->id)
            ->get();

        $compiledPermissions = [];

        foreach ($defaultPermissions as $defaultPermission) {
            $customizedPermissionWithSameId = $customizedPermissions->firstWhere('permission_id', $defaultPermission->permission_id);
            if ($customizedPermissionWithSameId) {
                $compiledPermissions[$customizedPermissionWithSameId->permission->key_name] = $customizedPermissionWithSameId;
            } else {
                $compiledPermissions[$defaultPermission->permission->key_name] = $defaultPermission;
            }
        }

        usort($compiledPermissions, function ($a, $b) {
            return $b->allowed <=> $a->allowed;
        });

        return view('private.user.permissions', compact('user', 'compiledPermissions'));
    }

    public function updatePermissions(Request $request, User $user)
    {
        Gate::authorize('user-permission-edit');

        $defaultRolePermissions = RolePermission::where('role_id', $user->roles[0]->id)->with('permission')->get();
        $currentUserPermissions = UserCustomPermission::where('user_id', $user->id)->with('permission')->get();

        $newPermissions = $request->except(['_token', '_method']);

        foreach ($newPermissions as $permissionKeyName => $permissionValue) {
            $hasDefaultPermissionWithSameValue = $defaultRolePermissions
                ->where('permission.key_name', $permissionKeyName)
                ->where('allowed', $permissionValue)
                ->first();

            $hasCustomizedPermissionWithSameValue = $currentUserPermissions
                ->where('permission.key_name', $permissionKeyName)
                ->first();

            if ($hasDefaultPermissionWithSameValue) {
                if ($hasCustomizedPermissionWithSameValue) {
                    $hasCustomizedPermissionWithSameValue->delete();
                }
            } else {
                if (! $hasCustomizedPermissionWithSameValue) {
                    $permissionId = Permission::where('key_name', '=', $permissionKeyName)->value('id');

                    UserCustomPermission::create([
                        'company_id' => session('auth:company')->id,
                        'user_id' => $user->id,
                        'permission_id' => $permissionId,
                        'allowed' => $permissionValue,
                    ]);
                }
            }
        }

        return to_route('user.show', $user)->with('message', 'Permissões atualizadas com sucesso!');
    }

    public function showDepartmentScope(User $user)
    {
        Gate::authorize('user-department-scope-edit');

        $companyDepartments = Company::firstWhere('id', session('auth:company')->id)
            ->users()
            ->pluck('department')
            ->unique()
            ->values()
            ->sortBy(function ($department) use ($user) {
                return $department === $user->department ? 0 : 1;
            })
        ->values();

        $userDepartmentPermissions = UserDepartmentPermission::where('company_id', session('auth:company')->id)
            ->where('user_id', $user->id)
            ->orderBy('allowed', 'desc')
            ->orderByRaw("CASE WHEN department = ? THEN 0 ELSE 1 END", [$user->department])
        ->get();


        return view('private.user.department-scope', compact('user', 'companyDepartments', 'userDepartmentPermissions'));
    }

    public function updateDepartmentScopes(Request $request, User $user)
    {
        Gate::authorize('user-department-scope-edit');

        $currentDepartmentScopes = UserDepartmentPermission::where('company_id', session('auth:company')->id)
            ->where('user_id', $user->id)
            ->get();

        $newDepartmentScopes = $request->except(['_token', '_method']);

        foreach($currentDepartmentScopes as $departmentScope){
            $newDepartmentRelated = $newDepartmentScopes[$departmentScope->department] ?? null;

            if($newDepartmentRelated){
                $departmentScope->allowed = 1;
                $departmentScope->save();
            } else{
                $departmentScope->allowed = 0;
                $departmentScope->save();
            }
        }

        foreach($newDepartmentScopes as $departmentName => $departmentScope){
            if(! $currentDepartmentScopes->firstWhere('department', $departmentName)){
                UserDepartmentPermission::create([
                    'company_id' => session('auth:company')->id,
                    'user_id' => $user->id,
                    'department' => $departmentName,
                    'allowed' => $departmentScope,
                ]);
            }
        }

        return to_route('user.permissions', $user)->with('message', 'Visão de Setores atualizada com sucesso!');
    }


    public function showResetPassword(Request $request, User $user)
    {
        return view('private.user.reset-password', compact('user'));
    }

    public function resetPassword(Request $request, User $user)
    {   
        $credentials = $request->validate([
            "current_password" => ['required'],
            'new_password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);
        
        if(AuthService::resetPassword('user', $user, $credentials)){  
            return redirect()->to(AuthService::redirectLoginRoute('user'));
        };
        
        return back()->with('message', 'Não foi possível redefinir sua senha.');
    }

    public function resetPasswordModal(Request $request, User $user)
    {   
        $credentials = $request->validate([
            "current_password" => ['required'],
            'new_password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);
        
        if(AuthService::resetPassword('user', $user, $credentials)){  
            return back()->with('message', 'Senha redefinida com sucesso!');
        };

        return back()->with('message', 'Não foi possível redefinir sua senha.');
    }

    public function verifyCPF(Request $request)
    {
        $request->validate([
            'cpf' => ['required']
        ]);

        $user = User::where('cpf', $request['cpf'])->first();

        return response()->json(['user' => $user]);
    }
}
