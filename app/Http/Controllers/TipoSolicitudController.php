<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoSolicitudRequest;
use App\Http\Resources\TipoSolicitudResource;
use App\Models\TipoSolicitud;

class TipoSolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipoSolicitudResource::collection(TipoSolicitud::all())
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoSolicitudRequest $request)
    {
        $tipoSolicitud = new TipoSolicitud($request->all());
        $tipoSolicitud->save();

        return (new TipoSolicitudResource($tipoSolicitud))
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
        return (new TipoSolicitudResource(TipoSolicitud::findOrFail($id)))
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
    public function update(TipoSolicitudRequest $request, $id)
    {
        //$validated = $request->validated();

        $tipoSolicitud = TipoSolicitud::findOrFail($id);
        $tipoSolicitud->update($request->all());

        return (new TipoSolicitudResource($tipoSolicitud))
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
        $tipoSolicitud = TipoSolicitud::findOrFail($id);
        $tipoSolicitud->delete();

        return response()->json(null, 204);
    }
}
