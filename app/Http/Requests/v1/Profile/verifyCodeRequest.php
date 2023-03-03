<?php

namespace App\Http\Requests\v1\Profile;

use App\Rules\CheckOtpRule;
use Illuminate\Foundation\Http\FormRequest;

class verifyCodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'phone' => 'required|string|starts_with:+998',
            'otp' => ['required', 'string', 'max:6', new CheckOtpRule($this->phone, $this->otp)],
        ];
    }
}
