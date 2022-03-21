<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaRequest;
use App\Http\Resources\EmpresaResource;
use App\Models\Empresa;
use App\Services\EmpresaFilesService;
use Carbon\Carbon;

class EmpresaController extends Controller
{
    /**
     * @var EmpleadoFilesService
     */
    protected $service;

    public function __construct(EmpresaFilesService $service)
    {
        //parent::__construct();
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::with(['areas','user'])
            ->withTrashed()
            ->get();

        return $this->response(EmpresaResource::collection($empresas));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpresaRequest $request)
    {

        $logoFile = $request->file('logo');

        $logoPath = $this->service->upload($logoFile);

        $empresa = Empresa::create([
            'user_id' => $request->input('user_id'),
            'denominacion_social' => $request->input('denominacion_social'),
            'cuit' => $request->input('cuit'),
            'email' => $request->input('email'),
            'logo' => $logoPath,
            'inicio_actividades' => Carbon::createFromFormat('d/m/Y', $request->input('inicio_actividades')),
            'clasificacion' => $request->input('clasificacion'),
            'domicilio_legal' => $request->input('domicilio_legal'),
            'domicilio_fiscal' => $request->input('domicilio_fiscal'),
            'telefono' => $request->input('telefono'),
            'moneda' => $request->input('moneda'),
        ]);

        return $this->response(new EmpresaResource($empresa));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empresa = Empresa::with(['areas','user'])->findOrFail($id);

        return $this->response(new EmpresaResource($empresa));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmpresaRequest $request, $id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->user_id = $request->input('user_id');
        $empresa->denominacion_social = $request->input('denominacion_social');
        $empresa->cuit = $request->input('cuit');
        $empresa->email = $request->input('email');
        $empresa->inicio_actividades = Carbon::createFromFormat('d/m/Y', $request->input('inicio_actividades'));
        $empresa->clasificacion = $request->input('clasificacion');
        $empresa->domicilio_legal = $request->input('domicilio_legal');
        $empresa->domicilio_fiscal = $request->input('domicilio_fiscal');
        $empresa->telefono = $request->input('telefono');
        $empresa->moneda = $request->input('moneda');

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = $this->service->upload($file);
            $empresa->logo = $path;
        }

        $empresa->save();

        return $this->response(new EmpresaResource($empresa));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empresa = Empresa::findOrFail($id);
        $this->service->delete($empresa->logo);
        $empresa->delete();

        return $this->response(new EmpresaResource($empresa));
    }
}
