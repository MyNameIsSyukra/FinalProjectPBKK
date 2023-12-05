<?php

namespace App\Listeners;

use App\Events\TopupRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class MakeTopupToken
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
    public function handle(TopupRequest $event): void
    {
        //
        $userId=$event->userId;
        $token= $event->token;
        $amount= $event->amount;
        Cache::put(`topup-request-{$token}`,json_encode([
            'userId' => $userId,
            "amount" => $amount
        ])
        ,600);
    }
}
