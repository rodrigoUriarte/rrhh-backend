<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmpresaResource extends JsonResource
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
            'denominacion_social' => $this->denominacion_social,
            'cuit' => $this->cuit,
            'email' => $this->email,
            'logo' => $this->logoUrl,
            'inicio_actividades' => $this->inicio_actividades,
            'clasificacion' => $this->clasificacion,
            'domicilio_legal' => $this->domicilio_legal,
            'domicilio_fiscal' => $this->domicilio_fiscal,
            'telefono' => $this->telefono,
            'moneda' => $this->moneda,
            'areas' => AreaResource::collection($this->whenLoaded('areas')),
            'user' => new UserResource($this->whenLoaded('user')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
