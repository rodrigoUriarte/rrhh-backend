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
        return TipoContratoResource::collection(TipoContrato::with(['contratos'])->get())
            ->response()
            ->setStatusCode(200);
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

        return (new TipoContratoResource($tipoContrato))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return (new TipoContratoResource(TipoContrato::with(['contratos'])->findOrFail($id)))
            ->response()
            ->setStatusCode(200);
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
        //$validated = $request->validated();

        $tipoContrato = TipoContrato::findOrFail($id);
        $tipoContrato->update($request->all());

        return (new TipoContratoResource($tipoContrato))
            ->response()
            ->setStatusCode(201);
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

        return response()->json(null, 204);
    }
}
