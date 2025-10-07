<?php

namespace App\Http\Controllers;

use App\Enums\RiskSeverityEnum;
use App\Models\ActionPlan;
use App\Models\ControlAction;
use App\Models\CustomControlAction;
use App\Models\Hazard;
use Illuminate\Http\Request;

class CustomControlActionController
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ActionPlan $actionPlan, Hazard $risk)
    {
        $validatedData = $request->validate([
            'control_action' => ['required'],
            'severity' => ['required'],
            'deadline' => ['nullable'],
            'assignee' => ['nullable'],
            'status' => ['nullable'],
        ]);

        CustomControlAction::create([
            'company_id' => session('auth:company')->id,
            'action_plan_id' => $actionPlan->id,
            'hazard_id' => $risk->id,
            'content' => $validatedData['control_action'],
            'severity' => $validatedData['severity'],
            'deadline' => $validatedData['deadline'] ?? null,
            'assignee' => $validatedData['assignee'] ?? null,
            'status' => $validatedData['status'] ?? null,
        ]);

        session(['company' => session('auth:company')->load('actionPlan.controlActions')]);

        return back()->with('message', 'Medida de Controle criada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActionPlan $actionPlan, Hazard $risk, CustomControlAction $controlAction)
    {
        $controlAction->delete();

        session(['company' => session('auth:company')->load('actionPlan.controlActions')]);

        return back()->with('message', 'Medida de Controle excluída com sucesso!');
    }
}
