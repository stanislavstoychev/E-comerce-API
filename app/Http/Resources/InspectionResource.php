<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InspectionResource extends JsonResource
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
            'project' => $this->project->abreviation,
            'structure' => $this->structure->name,
            'substructure' => $this->substructure->name,
            'part' => $this->part->abreviation,
            'step_id' => $this->step_id,
            'step_no' => $this->step->number,
            'step' => $this->step->name,
            'date' => $this->date,
            'time' => $this->time,
            'users' => $this->users,
            'status' => $this->status,
            'remark' => $this->remark
        ];
    }
}