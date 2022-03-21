<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpleadoRequest;
use App\Http\Resources\EmpleadoResource;
use App\Models\Empleado;
use App\Services\EmpleadoFilesService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * @var EmpleadoFilesService
     */
    protected $service;

    public function __construct(EmpleadoFilesService $service)
    {
        //parent::__construct();
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $empresa_id = $request->input('empresa_id');
        $empleados = Empleado::with(['contratos', 'solicitudes'])
            ->withTrashed()
            ->when($empresa_id, function (Builder $query) use ($empresa_id) {
                return $query->whereHas('contratos.cargo.departamento.area.empresa', function (Builder $query) use ($empresa_id) {
                    $query->where('id', $empresa_id);
                })->get();
            });

        return $this->response(EmpleadoResource::collection($empleados));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpleadoRequest $request)
    {

        $fotoPerfilFile = $request->file('foto_perfil');
        $preocupacionalFile = $request->file('preocupacional');

        $fotoPerfilPath = $this->service->upload($fotoPerfilFile);
        $preocupacionalPath = $this->service->upload($preocupacionalFile);

        $empleado = Empleado::create([
            'legajo' => $request->input('legajo'),
            'apellido' => $request->input('apellido'),
            'nombre' => $request->input('nombre'),
            'dni' => $request->input('dni'),
            'cuil' => $request->input('cuil'),
            'sexo' => $request->input('sexo'),
            'fecha_nacimiento' => Carbon::createFromFormat('d/m/Y', $request->input('fecha_nacimiento')),
            'lugar_nacimiento' => $request->input('lugar_nacimiento'),
            'domicilio' => $request->input('domicilio'),
            'email' => $request->input('email'),
            'telefono' => $request->input('telefono'),
            'foto_perfil' => $fotoPerfilPath,
            'fecha_ingreso' => Carbon::createFromFormat('d/m/Y', $request->input('fecha_ingreso')),
            'estado_civil' => $request->input('estado_civil'),
            'cantidad_hijos' => $request->input('cantidad_hijos'),
            'telefono_emergencia' => $request->input('telefono_emergencia'),
            'preocupacional' => $preocupacionalPath,
        ]);

        return $this->response(new EmpleadoResource($empleado));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = Empleado::with(['contratos', 'solicitudes'])->findOrFail($id);
        return $this->response(new EmpleadoResource($empleado));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmpleadoRequest $request, $id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->legajo = $request->input('legajo');
        $empleado->apellido = $request->input('apellido');
        $empleado->nombre = $request->input('nombre');
        $empleado->dni = $request->input('dni');
        $empleado->cuil = $request->input('cuil');
        $empleado->sexo = $request->input('sexo');
        $empleado->fecha_nacimiento = Carbon::createFromFormat('d/m/Y', $request->input('fecha_nacimiento'));
        $empleado->lugar_nacimiento = $request->input('lugar_nacimiento');
        $empleado->domicilio = $request->input('domicilio');
        $empleado->email = $request->input('email');
        $empleado->telefono = $request->input('telefono');
        $empleado->fecha_ingreso = Carbon::createFromFormat('d/m/Y', $request->input('fecha_ingreso'));
        $empleado->fecha_ingreso = Carbon::createFromFormat('d/m/Y', $request->input('fecha_baja'));
        $empleado->estado_civil = $request->input('estado_civil');
        $empleado->cantidad_hijos = $request->input('cantidad_hijos');
        $empleado->telefono_emergencia = $request->input('telefono_emergencia');

        if ($request->hasFile('foto_perfil')) {
            $file = $request->file('foto_perfil');
            $path = $this->service->upload($file);
            $empleado->foto_perfil = $path;
        }

        if ($request->hasFile('preocupacional')) {
            $file = $request->file('preocupacional');
            $path = $this->service->upload($file);
            $empleado->preocupacional = $path;
        }

        $empleado->save();

        return $this->response(new EmpleadoResource($empleado));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
        $this->service->delete($empleado->foto_perfil);
        $this->service->delete($empleado->preocupacional);
        $empleado->delete();

        return $this->response(new EmpleadoResource($empleado));
    }
}
