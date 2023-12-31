<?php

namespace App\Observers;

use App\Models\User;

class  UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $user->roles()->syncWithoutDetaching(request()->input('roles'));
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if (request()->has('roles')){
            $user->roles()->detach();
            $user->roles()->syncWithoutDetaching(request()->input('roles'));
        }

    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
