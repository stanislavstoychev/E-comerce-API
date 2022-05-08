<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SnagEditResource extends JsonResource
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
            'part_id' => $this->part_id,
            'part' => $this->part->name,
            'snag_no' => $this->snag_no,
            'description' => $this->description,
            'priority' => $this->priority,
            'unit_cost' => $this->unit_cost,
            'photos' => $this->photos,
        ];
    }
}