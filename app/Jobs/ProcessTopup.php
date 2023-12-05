<?php

namespace App\Jobs;

use App\Models\Wallet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ProcessTopup implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public $token
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Log::info("{$this->token}");
        $topupData = Cache::get("topup-request-{$this->token}");
        $data = json_decode($topupData);
        Cache::forget("topup-request-{$this->token}");
        // Log::info("{$topupData}");
        $wallet = Wallet::where('user_id',$data->userId)->first();
        if($wallet){
            $wallet->increment('amount', $data->amount);
            // Log::error("Wallet record  found");
        }
        else{
            Log::error("Wallet record of user not found");
        }
        //
    }
}
