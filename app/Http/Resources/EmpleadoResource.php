<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmpleadoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'legajo' => $this->legajo,
            'apellido' => $this->apellido,
            'nombre' => $this->nombre,
            'dni' => $this->dni,
            'cuil' => $this->cuil,
            'sexo' => $this->sexo,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'lugar_nacimiento' => $this->lugar_nacimiento,
            'domicilio' => $this->domicilio,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'foto_perfil' => $this->when(!empty($this->foto_perfil), $this->fotoPerfilUrl),
            'fecha_ingreso' => $this->fecha_ingreso,
            'fecha_baja' => $this->when(!empty($this->fecha_baja), $this->fecha_baja),
            'estado_civil' => $this->estado_civil,
            'cantidad_hijos' => $this->when(!empty($this->cantidad_hijos), $this->cantidad_hijos),
            'telefono_emergencia' => $this->telefono_emergencia,
            'preocupacional' => $this->preocupacionalUrl,
            'contratos' => ContratoResource::collection($this->whenLoaded('contratos')),
            'solicitudes' => SolicitudResource::collection($this->whenLoaded('solicitudes')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at

        ];
    }
}
