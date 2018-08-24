<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\LocationExistsInSchool;
use App\Rules\MentorsExistInSchool;

/**
 * Represents a HTTP POST request indicating that the user wants
 * to create a new ReportedCase.
 *
 * This class only contains the authorization and validation
 * methods and does not manipulate data in any way.
 */
class ReportCaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasRole('schueler');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'sometimes|string|min:3|nullable',
            'message' => 'required|string|min:10',
            'incident_date' => 'required|date|before:now|nullable',
            'category' => 'required|in:' . implode(",", config('exclamo.categories', '')),
            'location' => [
                'sometimes',
                'nullable',
                new LocationExistsInSchool($this->user())
            ],
            'mentors' => [
                'required',
                'array',
                'min:1',
                new MentorsExistInSchool($this->user())
            ],
            'anonymous' => 'sometimes'
        ];
    }
}
