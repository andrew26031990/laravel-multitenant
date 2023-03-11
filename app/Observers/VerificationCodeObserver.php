<?php

namespace App\Observers;

use App\Models\VerificationCode;
use App\Services\Project\TelegramService;
use Carbon\Carbon;

class VerificationCodeObserver
{
    public function creating(VerificationCode $verificationCode){
        $verificationCode->expired_at = Carbon::now()->addMinutes(50);
        $verificationCode->otp = rand(100000,999999);
    }

    public function created(VerificationCode $verificationCode){
        if(!app()->environment('testing'))
            TelegramService::sendMessage($verificationCode->otp);
    }
}
