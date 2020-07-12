<?php

namespace App\Observers;

use App\User;
use App\Jobs\ApiUserCreate;
use App\Jobs\ApiUserDelete;
use App\Jobs\ApiUserDowngrade;
use App\Jobs\ApiUserUpgrade;

use Illuminate\Support\Facades\Http;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        ApiUserCreate::dispatchNow( $user );
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        if ( $user->isDirty() && isset( $user->access_level ) ) {
            if ( $user->access_level === 'free' ) {
                ApiUserDowngrade::dispatchNow( $user );
            }elseif ( $user->access_level === 'premium' ) {
                ApiUserUpgrade::dispatchNow( $user );
            }
        }
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        ApiUserDelete::dispatchNow( $user );
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}