<?php

namespace App\Rules;

use App\Models\Tenant;
use Illuminate\Contracts\Validation\Rule;

class CheckIfCompanyExistRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
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
        return !Tenant::whereSlug(\Str::slug($this->name))->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('Company already exist');
    }
}
