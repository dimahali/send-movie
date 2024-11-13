<?php

namespace App\Policies;

use Spatie\Comments\Models\Concerns\Interfaces\CanComment;
use Spatie\LivewireComments\Policies\CommentPolicy;

class CustomCommentPolicy extends CommentPolicy
{
    public function update(?CanComment $user, $comment): bool
    {
        if (!$user) {
            return false;
        }
        return $user->isAdmin();
    }

    public function delete(?CanComment $user, $comment): bool
    {
        if (!$user) {
            return false;
        }
        return $user->isAdmin();
    }

    public function approve(CanComment $user, $comment): bool
    {
        return $user->isAdmin();
    }
}
