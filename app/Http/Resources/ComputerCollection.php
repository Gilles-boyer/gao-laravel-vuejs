<?php

namespace App\Http\Resources;

use App\Http\Resources\AttributionCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ComputerCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $attribution = AttributionCollection::collection($this->attributions);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'attributions' => $attribution
        ];
    }
}
