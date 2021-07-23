<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Veiculo extends JsonResource
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
        'placa' => $this->placa,
        'veiculo' => $this->veiculo,
        'renavan' => $this->renavan,
        'vencimento' => $this->vencimento,
        'valor_doc' => $this->valor_doc,
        'responsavel' => $this->responsavel,
        'ano_modelo' => $this->ano_modelo,
        'uf' => $this->uf,
        'fipe' => $this->fipe,
        'tbDepartamentos_id' => $this->tbDepartamentos_id,
        'tbFiliais_id' => $this->tbFiliais_id,
      ];
    }
}
