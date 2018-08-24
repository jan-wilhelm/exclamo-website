<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;

class MentorsExistInSchool implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Determine if all of the selected mentors are
     * actually mentors at the user's school
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($value as $index => $mentorId) {

            if (!is_numeric($mentorId)) {
                return false;
            }

            $mentorId = intval($mentorId);
            $mentor = User::find($mentorId);

            // Check if the user exists
            if (!$mentor) {
                return false;
            }

            // Check if the selected user even is a mentor
            if (!$mentor->isMentor()) {
                return false;
            }

            // Check if the mentor is actively mentoring
            if (!$mentor->mentoring) {
                return false;
            }

            // Check if the schools are the same
            if (!$mentor->school->id == $this->user->school->id) {
                return false;
            }
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
        return 'The selected mentors must be members of your school and must offer mentoring';
    }
}
