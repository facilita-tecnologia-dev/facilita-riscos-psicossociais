<?php

namespace App\Http\Controllers\Private;

use App\Exports\FeedbacksExport;
use App\Models\UserFeedback;
use App\Services\User\UserFilterService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class UserFeedbackController
{
    protected $filterService;

    public function __construct(UserFilterService $filterService)
    {
        $this->filterService = $filterService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('feedbacks-index');
        $userFeedbacks = $this->query($request);
        $filteredUserCount = $userFeedbacks->total();
        $filtersApplied = array_filter($request->query(), fn ($queryParam) => $queryParam != null);

        return view('private.dashboard.feedback.index', [
            'userFeedbacks' => $userFeedbacks->count() ? $userFeedbacks : null,
            'filtersApplied' => $filtersApplied,
            'filteredUserCount' => $filteredUserCount ? $filteredUserCount : null,
        ]);
    }

    private function query(Request $request)
    {
        $query = session('auth:company')->users()->getQuery();

        return $this->filterService->sort($this->filterService->apply($query))
            ->whereHas('feedbacks', function ($query) use ($request) {
                $query->whereYear('created_at', $request->year ?? Carbon::now()->year)
                        ->where('company_id', session('auth:company')->id);
            })
            ->select('users.id', 'name', 'department', 'work_shift')
            ->with('feedbacks', fn ($query) => $query->latest()->limit(1))
            ->paginate(15)->appends(request()->query());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        dd('oi');
        return view('private.tests.feedback');
    }
    
    public function export(){
        return Excel::download(new FeedbacksExport, session('auth:company')->getFirstName() . ' - Pesquisa de Clima Organizacional - Comentários.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'feedback' => 'nullable|string|min:12',
        ]);

        if ($validatedData['feedback'] == null) {
            return to_route('complete-tests.thanks');
        }

        UserFeedback::create([
            'company_id' => session('auth:company')->id,
            'user_id' => session('auth:user')->id,
            'content' => $validatedData['feedback'],
        ]);

        return to_route('logout');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserFeedback $feedback)
    {
        Gate::authorize('feedbacks-index');
        $parentUser = $feedback->parentUser;

        return view('private.dashboard.feedback.show', compact('feedback', 'parentUser'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserFeedback $userFeedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserFeedback $userFeedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserFeedback $userFeedback)
    {
        //
    }
}
