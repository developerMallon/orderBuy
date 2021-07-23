<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FilialDepartamento extends JsonResource
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
        'tbFiliais_id' => $this->tbFiliais_id,
        'tbDepartamentos_id' => $this->tbDepartamentos_id
      ];
    }
}
