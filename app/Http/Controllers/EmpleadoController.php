<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpleadoRequest;
use App\Http\Resources\EmpleadoResource;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EmpleadoResource::collection(Empleado::all())
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empleado = Empleado::create([
            'legajo' => $request->legajo,
            'apellido' => $request->apellido,
            'nombre' => $request->nombre,
            'dni' => $request->dni,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'domicilio' => $request->domicilio,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'foto_perfil' => $request->foto_perfil,
            'sexo' => $request->sexo,
            'fecha_ingreso' => $request->fecha_ingreso,
            'telefono_emergencia' => $request->telefono_emergencia,
            'documentacion' => $request->documentacion,
            'estado_civil' => $request->estado_civil,
        ]);

        return (new EmpleadoResource($empleado))
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
        return (new EmpleadoResource(Empleado::findOrFail($id)))
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
    public function update(EmpleadoRequest $request)
    {
        //$validated = $request->validated();

        $empleado = Empleado::findOrFail($request->empleado_id);
        $empleado->legajo = $request->legajo;
        $empleado->apellido = $request->apellido;
        $empleado->nombre = $request->nombre;
        $empleado->dni = $request->dni;
        $empleado->fecha_nacimiento = $request->fecha_nacimiento;
        $empleado->domicilio = $request->domicilio;
        $empleado->email = $request->email;
        $empleado->telefono = $request->telefono;
        $empleado->foto_perfil = $request->foto_perfil;
        $empleado->sexo = $request->sexo;
        $empleado->fecha_ingreso = $request->fecha_ingreso;
        $empleado->telefono_emergencia = $request->telefono_emergencia;
        $empleado->documentacion = $request->documentacion;
        $empleado->estado_civil = $request->estado_civil;

        $empleado->save();

        return (new EmpleadoResource($empleado))
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
        $user = Empleado::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }
}
