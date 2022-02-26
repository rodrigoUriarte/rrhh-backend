<?php

namespace App\Http\Controllers;

use App\Http\Requests\SolicitudRequest;
use App\Http\Resources\SolicitudResource;
use App\Models\Solicitud;
use Carbon\Carbon;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudes = Solicitud::with(['empleado', 'tipoSolicitud'])
            ->withTrashed()
            ->get();

        return $this->response(SolicitudResource::collection($solicitudes));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SolicitudRequest $request)
    {
        $solicitud = Solicitud::create([
            'empleado_id' => $request->input('empleado_id'),
            'tipo_solicitud_id' => $request->input('tipo_solicitud_id'),
            'nombre' => $request->input('nombre'),
            'fecha' => Carbon::createFromFormat('d/m/Y', $request->input('fecha')),
            'aprobado' => $request->input('aprobado'),
        ]);
        $solicitud->save();

        return $this->response(new SolicitudResource($solicitud));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solicitud = Solicitud::with(['empleado', 'tipoSolicitud'])->findOrFail($id);

        return $this->response(new SolicitudResource($solicitud));
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
        $solicitud = Solicitud::findOrFail($id);

        $solicitud->empleado_id = $request->input('empleado_id');
        $solicitud->tipo_solicitud_id = $request->input('tipo_solicitud_id');
        $solicitud->nombre = $request->input('nombre');
        $solicitud->fecha = Carbon::createFromFormat('d/m/Y', $request->input('fecha'));
        $solicitud->aprobado = $request->input('aprobado');

        $solicitud->save();

        return $this->response(new SolicitudResource($solicitud));
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

        return $this->response(new SolicitudResource($solicitud));
    }
}
