<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContratoRequest;
use App\Http\Resources\ContratoResource;
use App\Models\Contrato;
use Carbon\Carbon;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contratos = Contrato::with(['empleado', 'tipoContrato', 'cargo'])
            ->withTrashed()
            ->get();

        return $this->response(ContratoResource::collection($contratos));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContratoRequest $request)
    {
        $contrato = Contrato::create([
            'empleado_id' => $request->input('empleado_id'),
            'tipo_contrato_id' => $request->input('tipo_contrato_id'),
            'cargo_id' => $request->input('cargo_id'),
            'nombre' => $request->input('nombre'),
            'fecha' => Carbon::createFromFormat('d/m/Y', $request->input('fecha')),
            'basico' => $request->input('basico'),
        ]);
        $contrato->save();

        return $this->response(new ContratoResource($contrato));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contrato = Contrato::with(['empleado', 'tipoContrato', 'cargo'])->findOrFail($id);

        return $this->response(new ContratoResource($contrato));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContratoRequest $request, $id)
    {
        $contrato = Contrato::findOrFail($id);
        $contrato->empleado_id = $request->input('empleado_id');
        $contrato->tipo_contrato_id = $request->input('tipo_contrato_id');
        $contrato->cargo_id = $request->input('cargo_id');
        $contrato->nombre = $request->input('nombre');
        $contrato->fecha = Carbon::createFromFormat('d/m/Y', $request->input('fecha'));
        $contrato->basico = $request->input('basico');

        $contrato->save();

        return $this->response(new ContratoResource($contrato));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contrato = Contrato::findOrFail($id);
        $contrato->delete();

        return $this->response(new ContratoResource($contrato));
    }
}
