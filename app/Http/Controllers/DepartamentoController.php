<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartamentoRequest;
use App\Http\Resources\DepartamentoResource;
use App\Models\Departamento;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DepartamentoResource::collection(Departamento::with(['area','cargos'])->get())
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartamentoRequest $request)
    {
        $departamento = new Departamento($request->all());
        $departamento->save();

        return (new DepartamentoResource($departamento))
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
        return (new DepartamentoResource(Departamento::with(['area','cargos'])->findOrFail($id)))
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
    public function update(DepartamentoRequest $request, $id)
    {
        //$validated = $request->validated();

        $departamento = Departamento::findOrFail($id);
        $departamento->update($request->all());

        return (new DepartamentoResource($departamento))
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
        $departamento = Departamento::findOrFail($id);
        $departamento->delete();

        return response()->json(null, 204);
    }
}
