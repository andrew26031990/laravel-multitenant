<?php

namespace App\Listeners;

use DB;
use Laravel\Passport\Events\RefreshTokenCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PruneOldTokens
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RefreshTokenCreated $event): void
    {
        /*DB::table('oauth_refresh_tokens')
            ->where('id', '<>', $event->refreshTokenId)
            ->where('access_token_id', '<>', $event->accessTokenId)
            ->update(['revoked' => true]);*/
    }
}
