<?php

namespace App\Observers;

use App\Models\User;
use Storage;

class UserObserver
{
    public function updated(User $user): void
    {
        if ($user->isDirty('avatar_url')) {
            $originalProfileImage = $user->getOriginal('avatar_url');

            if ($originalProfileImage && Storage::disk('public')->exists($originalProfileImage)) {
                Storage::disk('public')->delete($originalProfileImage);
            }
        }
    }

    public function deleted(User $user): void
    {
        if (!is_null($user->avatar_url) && Storage::disk('public')->exists($user->avatar_url)) {
            Storage::disk('public')->delete($user->avatar_url);
        }
    }
}
