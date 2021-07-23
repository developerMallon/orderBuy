<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Usuario extends JsonResource
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
        'email' => $this->email,
        'email_verified_at' => $this->email_verified_at,
        'senha' => $this->senha,
        'tbFilais_id' => $this->tbFilais_id,
        'tbDepartamentos_id' => $this->tbDepartamentos_id,
        'tbNiveis_Login' => $this->tbNiveis_Login,
      ];
    }
}
