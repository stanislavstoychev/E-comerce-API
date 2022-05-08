<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'code' => $this->name,
            'name' => $this->name,
            'part' => $this->part->name,
            'part_id' => $this->part_id,
            'subcontractor_id' => $this->subcontractor_id,
            'subcontractor' => $this->subcontractor->name,
            'image' => $this->image,
            'quantity' => $this->quantity,
            'buying_date' => $this->buying_date,
            'root' => $this->root,
            'buying_price' => $this->buying_price,
            'selling_price' => $this->selling_price,
        ];
    }
}
