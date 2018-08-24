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
            'mentors' => ConfidentialUserResource::collection($this->mentors),
            'category' => $this->category,
            'anonymous' => boolval($this->anonymous),
            'solved' => boolval($this->solved),
            'location_id' => $this->location->id
        ];
    }
}
