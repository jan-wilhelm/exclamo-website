<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\School;

class SchoolSupportsDates implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(School $school)
    {
        $this->school = $school;
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
        return $this->school->uses_dates;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The school does not support dates!';
    }
}
