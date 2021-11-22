<?php

namespace App\Http\Controllers;

use App\Http\Requests\CargoRequest;
use App\Http\Resources\CargoResource;
use App\Models\Cargo;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CargoResource::collection(Cargo::with(['departamento','contrato'])->get())
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CargoRequest $request)
    {
        $cargo = new Cargo($request->all());
        $cargo->save();

        return (new CargoResource($cargo))
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
        return (new CargoResource(Cargo::with(['departamento','contrato'])->findOrFail($id)))
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
    public function update(CargoRequest $request, $id)
    {
        //$validated = $request->validated();

        $cargo = Cargo::findOrFail($id);
        $cargo->update($request->all());

        return (new CargoResource($cargo))
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
        $cargo = Cargo::findOrFail($id);
        $cargo->delete();

        return response()->json(null, 204);
    }
}
