<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContratoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'empleado' => new EmpleadoResource($this->whenLoaded('empleado')),
            'tipoContrato' => new TipoContratoResource($this->whenLoaded('tipoContrato')),
            'cargo' => new CargoResource($this->whenLoaded('cargo')),
            'nombre' => $this->nombre,
            'fecha' => $this->nombre,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
