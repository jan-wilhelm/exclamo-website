<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $array = [
            'id' => $this->id,
            'case' => $this->reported_case_id,
            'body' => $this->body,
            'date' => $this->updated_at->timestamp,
            'anonymous' => $this->reportedCase->anonymous
        ];

        if (!$this->reportedCase->anonymous)
        {
            $array['user'] = (new ConfidentialUserResource($this->sender))->toArray($request);
        }

        return $array;
    }
}
