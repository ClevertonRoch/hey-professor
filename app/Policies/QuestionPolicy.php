<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class QuestionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function publish(User $user, Question $question): bool
    {
        return $question->createdBy()->is($user);
    }


}
