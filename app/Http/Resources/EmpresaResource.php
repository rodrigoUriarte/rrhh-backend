<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmpresaResource extends JsonResource
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
            'areas' => AreaResource::collection($this->whenLoaded('areas')),
            'denominacion_social' => $this->denominacion_social,
            'clasificacion' => $this->clasificacion,
            'domicilio' => $this->domicilio,
            'telefono' => $this->telefono,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
