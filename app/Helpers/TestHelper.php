<?php

if(!function_exists('mockUser')){
    function mockUser(){
        $phone = '+998909101828';
        $user = app(\App\Services\CentralUserService::class)->sendOtp(['phone' => $phone, 'is_active' => true]);
        $otp = $user->verificationCodes()->latest()->first()->otp;
        $request = [
            'phone' => $phone,
            'otp' => $otp
        ];
        return app(\App\Services\CentralUserService::class)->verifyOtp($request);
    }
}
