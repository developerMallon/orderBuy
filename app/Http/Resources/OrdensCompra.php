<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrdensCompra extends JsonResource
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
      'solicitante' => $this->solicitante,
      'motivo' => $this->motivo,
      'km' => $this->km,
      'valor' => $this->valor,
      'tbFiliais_id' => $this->tbFiliais_id,
      'tbDepartamentos_id' => $this->tbDepartamentos_id,
      'tbUsuarios_id' => $this->tbUsuarios_id,
      'tbTipos_id' => $this->tbTipos_id,
      'tbVeiculos_id' => $this->tbVeiculos_id,
    ];
  }
}
