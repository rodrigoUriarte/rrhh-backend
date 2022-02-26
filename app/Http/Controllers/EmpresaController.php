<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaRequest;
use App\Http\Resources\EmpresaResource;
use App\Models\Empresa;
use App\Services\EmpresaFilesService;

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
        $empresas = Empresa::with(['areas'])
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
            'denominacion_social' => $request->input('denominacion_social'),
            'cuit' => $request->input('cuit'),
            'email' => $request->input('email'),
            'logo' => $logoPath,
            'clasificacion' => $request->input('clasificacion'),
            'domicilio' => $request->input('domicilio'),
            'telefono' => $request->input('telefono'),
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
        $empresa = Empresa::with(['areas'])->findOrFail($id);

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
        $empresa->denominacion_social = $request->input('legajo');
        $empresa->cuit = $request->input('apellido');
        $empresa->email = $request->input('nombre');
        $empresa->clasificacion = $request->input('dni');
        $empresa->domicilio = $request->input('cuil');
        $empresa->telefono = $request->input('sexo');

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
