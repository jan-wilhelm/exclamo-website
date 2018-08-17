<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\LocationExistsInSchool;
use App\Rules\MentorsExistInSchool;

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
            'incident_date' => 'sometimes|date|before:now|nullable',
            'category' => 'sometimes|in:' . implode(",", array_keys(config('exclamo.categories', ''))),
            'location' => [
                'sometimes',
                'nullable',
                new LocationExistsInSchool($this->user())
            ],
            'mentors' => [
                'sometimes',
                'array',
                'min:1',
                new MentorsExistInSchool($this->user())
            ],
            'anonymous' => 'sometimes|bool',
            'solved' => 'sometimes|bool'
        ];
    }
}
