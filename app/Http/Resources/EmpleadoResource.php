<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmpleadoResource extends JsonResource
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
            'contratos' => ContratoResource::collection($this->whenLoaded('contratos')),
            'solicitudes' => SolicitudResource::collection($this->whenLoaded('solicitudes')),
            'legajo' => $this->legajo,
            'apellido' => $this->apellido,
            'nombre' => $this->nombre,
            'dni' => $this->dni,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'domicilio' => $this->domicilio,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'foto_perfil' => $this->foto_perfil,
            'sexo' => $this->sexo,
            'fecha_ingreso' => $this->fecha_ingreso,
            'telefono_emergencia' => $this->telefono_emergencia,
            'documentacion' => $this->documentacion,
            'estado_civil' => $this->estado_civil,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
