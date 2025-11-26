<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Helpers\SessionErrorHelper;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationService {
    public static function attempt($guard, $credentials)
    {
        if($guard === 'company'){
            if(Auth::guard($guard)->attempt($credentials)){
                self::putGuardOnSession('company');
                self::putUserOnSession('company');
                self::putCompanyOnSession(Auth::guard('company')->user());
            } else {
                SessionErrorHelper::flash('cnpj', 'Credenciais incorretas.');
                return false;
            }
        }

        if($guard === 'cms'){
            if(Auth::guard($guard)->attempt($credentials)){
                self::putGuardOnSession('cms');
            } else {
                SessionErrorHelper::flash('user', 'Credenciais incorretas.');
                return false;
            }
        }
       
        return self::redirectLoginRoute($guard); 
    }

    public static function authenticate(string $guard, $actor)
    {
        if($guard === 'user') Auth::guard('user')->login($actor);
        if($guard === 'company') Auth::guard('company')->login($actor);

        self::putUserOnSession($guard);

        session()->regenerate();
    }

    public static function logout(Request $request)
    {
        $guard = session('auth:guard');
        
        Auth::guard(session('auth:guard'))->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return self::redirectLogoutRoute($guard);
    }

    public static function resetPassword(string $guard, $actor, $credentials)
    {
        if($guard === 'user'){
            if($actor->is_temp_password){
                if($credentials['current_password'] !== $actor->password){
                    SessionErrorHelper::flash('current_password', 'Senha incorreta.');
                    return false;
                }
    
                if($credentials['new_password'] === $actor->password){
                    SessionErrorHelper::flash('new_password', 'Essa senha já foi/está sendo utilizada.');
                    return false;
                }
            } else{
                if(!Hash::check($credentials['current_password'], $actor->password)){
                    SessionErrorHelper::flash('current_password', 'Senha incorreta.');
                    return false;
                }
    
                if(Hash::check($credentials['new_password'], $actor->password)){
                    SessionErrorHelper::flash('new_password', 'Essa senha já foi/está sendo utilizada.');
                    return false;
                }
            }
    
            $actor->update([
                'password' => Hash::make($credentials['new_password']),
                'is_temp_password' => false,
            ]);

            return true;
        }

        if($guard === 'company'){
            if(!Hash::check($credentials['current_password'], $actor->password)){
                SessionErrorHelper::flash('current_password', 'Senha incorreta.');
                return false;
            }

            if(Hash::check($credentials['new_password'], $actor->password)){
                SessionErrorHelper::flash('new_password', 'Essa senha já foi/está sendo utilizada.');
                return false;
            }

            $actor->update([
                'password' => Hash::make($credentials['new_password']),
            ]);

            return true;
        }
    }

    public static function checkUserHasMultipleCompanies(User $user)
    {
        return $user->companies->count() > 1;
    }

    public static function checkUserIsManager(User $user)
    {
        return $user->hasRole(RoleEnum::MANAGER->value);
    }

    public static function redirectLoginRoute($guard)
    {
        return match ($guard) {
            'company' => route('company.home'),
            'user'    => route('user.home'),
            'cms'    => route('cms.psychosocial.dashboard'),
            default   => route('site.home'),
        };
    }

    public static function redirectLogoutRoute($guard)
    {
        return match ($guard) {
            'company' => route('company.login'),
            'user'    => route('user.login'),
            'cms'    => route('cms.login'),
            default   => route('site.home'),
        };
    } 

    public static function checkPassword(string $value, string $hashed)
    {
        if(!Hash::check($value, $hashed)){ 
            SessionErrorHelper::flash('password', 'A senha está incorreta.');
            return false;
        }
        
        return true;
    }

    public static function checkTempPassword(string $value, string $temp)
    {
        if($value !== $temp){ 
            SessionErrorHelper::flash('password', 'A senha está incorreta.');
            return false;
        }
        
        return true;
    }

    public static function putGuardOnSession(string $guard): void
    {
        session()->put('auth:guard', $guard);
    }

    public static function putUserOnSession(string $guard): void
    {
        session()->put('auth:user', Auth::guard($guard)->user());
    }
        
    public static function putCompanyOnSession(Company $company): void
    {
        session()->put('auth:company', $company);
    }
}