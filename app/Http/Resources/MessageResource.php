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
        return [
            'id' => $this->id,
            'case' => $this->reported_case_id,
            'user' => new ConfidentialUserResource($this->sender),
            'body' => $this->body,
            'date' => $this->updated_at->timestamp
        ];
    }
}
