<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\LocationExistsInSchool;
use App\Rules\MentorsExistInSchool;
use App\Rules\SchoolSupportsLocations;
use App\Rules\SchoolSupportsDates;

class UpdateReportedCaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRole('schueler');
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
            'category' => 'sometimes|in:' . implode(",", config('exclamo.categories', '')),
            'anonymous' => 'sometimes|bool',
            'solved' => 'sometimes|bool',
            'location_id' => [
                'sometimes',
                'nullable',
                new LocationExistsInSchool($this->user()),
                new SchoolSupportsLocations($this->user()->school)
            ],
            'mentors' => [
                'sometimes',
                'array',
                'min:1',
                new MentorsExistInSchool($this->user())
            ],
            'incident_date' => [
                'sometimes',
                'date',
                'before:now',
                'nullable',
                new SchoolSupportsDates($this->user()->school)
            ],
        ];
    }
}
