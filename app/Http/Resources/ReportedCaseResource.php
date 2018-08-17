<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportedCaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'title'=> $this->title,
            'user' => [
                'id' => $this->victim->id,
                'name' => $this->victim->full_name
            ],
            'mentors' => $this->mentors->map(function($mentor, $index) {
                    return [
                        'id'=> $mentor->id,
                        'name'=> $mentor->full_name
                    ];
                }),
            'category' => array_search($this->category, config('exclamo.categories')),
            'anonymous' => boolval($this->anonymous),
            'solved' => boolval($this->solved),
            'location' => $this->location->id
        ];
    }
}
