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
        $tiposSolicitud = TipoSolicitud::with(['solicitudes'])
            ->withTrashed()
            ->get();

        return $this->response(TipoSolicitudResource::collection($tiposSolicitud));
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

        return $this->response(new TipoSolicitudResource($tipoSolicitud));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoSolicitud = TipoSolicitud::with(['solicitudes'])->findOrFail($id);

        return $this->response(new TipoSolicitudResource($tipoSolicitud));
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
        $tipoSolicitud = TipoSolicitud::findOrFail($id);
        $tipoSolicitud->update($request->all());

        return $this->response(new TipoSolicitudResource($tipoSolicitud));
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

        return $this->response(new TipoSolicitudResource($tipoSolicitud));
    }
}
