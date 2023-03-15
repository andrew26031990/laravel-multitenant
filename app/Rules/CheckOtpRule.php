<?php

namespace App\Rules;

use App\Exceptions\OtpExpiredException;
use App\Exceptions\OtpInvalidException;
use App\Models\CentralUser;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;

class CheckOtpRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $phone;
    public $otp;

    public function __construct($phone, $otp)
    {
        $this->phone = $phone;
        $this->otp = $otp;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $latestOtpRecord = CentralUser::wherePhone($this->phone)->firstOrFail()->verificationCodes()->latest()->first();

        if(Carbon::now() > $latestOtpRecord->expired_at){
            throw new OtpExpiredException(__('OTP expired'));
        }

        if($this->otp != $latestOtpRecord->otp){
            throw new OtpInvalidException(__('Invalid OTP code'));
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
