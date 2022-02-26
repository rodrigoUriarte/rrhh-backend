<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoContratoRequest;
use App\Http\Resources\TipoContratoResource;
use App\Models\TipoContrato;

class TipoContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposContrato = TipoContrato::with(['contratos'])
            ->withTrashed()
            ->get();

        return $this->response(TipoContratoResource::collection($tiposContrato));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoContratoRequest $request)
    {
        $tipoContrato = new TipoContrato($request->all());
        $tipoContrato->save();

        return $this->response(new TipoContratoResource($tipoContrato));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoContrato = TipoContrato::with(['contratos'])->findOrFail($id);

        return $this->response(new TipoContratoResource($tipoContrato));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoContratoRequest $request, $id)
    {
        $tipoContrato = TipoContrato::findOrFail($id);
        $tipoContrato->update($request->all());

        return $this->response(new TipoContratoResource($tipoContrato));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoContrato = TipoContrato::findOrFail($id);
        $tipoContrato->delete();

        return $this->response(new TipoContratoResource($tipoContrato));
    }
}
