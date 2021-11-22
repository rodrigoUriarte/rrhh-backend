<?php

namespace App\Http\Controllers;

use App\Http\Requests\SolicitudRequest;
use App\Http\Resources\SolicitudResource;
use App\Models\Solicitud;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SolicitudResource::collection(Solicitud::with(['empleado','tipoSolicitud'])->get())
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SolicitudRequest $request)
    {
        $solicitud = new Solicitud($request->all());
        $solicitud->save();

        return (new SolicitudResource($solicitud))
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
        return (new SolicitudResource(Solicitud::with(['empleado','tipoSolicitud'])->findOrFail($id)))
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
    public function update(SolicitudRequest $request, $id)
    {
        //$validated = $request->validated();

        $solicitud = Solicitud::findOrFail($id);
        $solicitud->update($request->all());

        return (new SolicitudResource($solicitud))
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
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->delete();

        return response()->json(null, 204);
    }
}
