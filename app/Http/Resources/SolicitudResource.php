<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SolicitudResource extends JsonResource
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
            'tipoSolicitud' => new TipoSolicitudResource($this->whenLoaded('tipoSolicitud')),
            'nombre' => $this->nombre,
            'fecha' => $this->fecha,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
