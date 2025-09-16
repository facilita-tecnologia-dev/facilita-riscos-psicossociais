<?php

use App\Models\Company;
use App\Models\User;
use App\Models\UserFeedback;

beforeEach(function () {
    $this->actingAs(User::first());
    session(['company' => Company::first()]);
});

it('should be able to see the feedbacks list page', function () {
    $response = $this->get(route('feedback.index'));

    $response->assertOk();
    $response->assertViewHasAll(['userFeedbacks', 'filtersApplied', 'filteredUserCount']);
});

it('should be able to see feedback detail', function () {
    $feedback = UserFeedback::where('company_id', session('company')->id)->first();
    $response = $this->get(route('feedback.show', $feedback));

    $response->assertOk();
    $response->assertViewHas('feedback', fn ($userFeedback) => $userFeedback->id == $feedback->id);
    $response->assertViewHas('parentUser');
});

it('should be able to see the feedback create page', function () {
    $response = $this->get(route('feedback.create'));
    $response->assertOk();
});

it('should be able to send a filled feedback', function () {
    $response = $this->post(route('feedback.create'), [
        'feedback' => 'Meu feedback',
    ]);

    $response->assertRedirectToRoute('complete-tests.thanks');
});

it('should be able to send a empty / not send a feedback', function () {
    $response = $this->post(route('feedback.create'), [
        'feedback' => '',
    ]);

    $response->assertRedirectToRoute('complete-tests.thanks');
});
