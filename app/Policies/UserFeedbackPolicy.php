<?php

namespace App\Policies;

use Illuminate\Contracts\Auth\Authenticatable;

class UserFeedbackPolicy extends BasePolicy
{
    public function viewAny(Authenticatable $user): bool
    {
        return $this->checkPermission('feedbacks_index');
    }
}
