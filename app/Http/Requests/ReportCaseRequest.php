<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\LocationExistsInSchool;
use App\Rules\MentorsExistInSchool;
use App\Rules\SchoolSupportsDates;
use App\Rules\SchoolSupportsLocations;

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
        $rules = [
            'title' => 'sometimes|string|min:3|nullable',
            'message' => 'required|string|min:10',
            'category' => 'required|in:' . implode(",", config('exclamo.categories', '')),
            'mentors' => [
                'required',
                'array',
                'min:1',
                new MentorsExistInSchool($this->user())
            ],
            'anonymous' => 'sometimes',
        ];

        if ($this->user()->school->uses_dates) {
            $rules['incident_date'] = [
                'required',
                'date',
                'before:now',
                'nullable',
                new SchoolSupportsDates($this->user()->school)
            ];
        }

        if ($this->user()->school->uses_locations) {
            $rules['location'] = [
                'sometimes',
                'nullable',
                new LocationExistsInSchool($this->user()),
                new SchoolSupportsLocations($this->user()->school)
            ];
        }

        return $rules;
    }
}
