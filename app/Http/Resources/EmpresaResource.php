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
            'clasificacion' => $this->clasificacion,
            'domicilio' => $this->domicilio,
            'telefono' => $this->telefono,
            'areas' => AreaResource::collection($this->whenLoaded('areas')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
