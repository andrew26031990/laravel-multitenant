<?php

namespace App\Http\Requests\v1\Company;

use App\Rules\CheckCompanyExistRule;
use App\Rules\CheckIfCompanyExistRule;
use Illuminate\Foundation\Http\FormRequest;

class storeTenantRequest extends FormRequest
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
            'name' => ['required', 'string', new CheckIfCompanyExistRule($this->name)]
        ];
    }
}
