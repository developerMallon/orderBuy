<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class Filial extends JsonResource
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
      'nome' => $this->nome,
      'cnpj' => $this->cnpj,
      'ie' => $this->ie,
      'rua' => $this->rua,
      'numero' => $this->numero,
      'bairro' => $this->bairro,
      'cidade' => $this->cidade,
      'uf' => $this->uf,
      'obs' => $this->obs
    ];
  }
}
