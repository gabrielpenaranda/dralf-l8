<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePersonaRequest;
use App\Http\Requests\UpdatePersonaRequest;
use App\Models\Tercero;
use App\Models\TipoPersona;
use App\Models\Bitacora;
use App\Models\Persona;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Persona::orderBy('apellido', 'asc')->orderBy('nombre', 'asc')->paginate(7);
        return view('dralf.personas.index')->with(['personas' => $personas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personas = new Persona;
        $terceros = Tercero::orderBy('nombre', 'asc')->get();
        $tipopersonas = TipoPersona::orderBy('nombre', 'asc')->get();
        $titulo = 'Crear Persona';
        return view('dralf.personas.form')->with(['personas' => $personas, 'terceros' => $terceros, 'tipopersonas' => $tipopersonas, 'titulo' => $titulo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePersonaRequest $request)
    {
        $personas = new Persona;
        $personas->apellido = strtoupper($request->get('apellido'));
        $personas->nombre = strtoupper($request->get('nombre'));
        $personas->cargo = strtoupper($request->get('cargo'));
        $personas->email = strtolower($request->get('email'));
        $personas->telefono = strtoupper($request->get('telefono'));
        $personas->tipopersonas_id = $request->get('tipopersonas_id');
        $personas->terceros_id = $request->get('terceros_id');
        $personas->save();
        $bitacoras = new Bitacora;
        $persona = $personas->nombre.' '.$personas->apellido;
        $bitacoras->register($bitacoras, 'C', $persona, $personas->id, 'personas', auth()->user()->id);
        session()->flash('message', 'Persona creada con ??xito!');
        return redirect()->route('personas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $personas
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $personas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $personas
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $personas)
    {
        $terceros = Tercero::orderBy('nombre', 'asc')->get();
        $tipopersonas = TipoPersona::orderBy('nombre', 'asc')->get();
        $titulo = 'Editar Persona';
        return view('dralf.personas.form')->with(['personas' => $personas, 'tipopersonas' => $tipopersonas,  'terceros' => $terceros, 'titulo' => $titulo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $personas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePersonaRequest $request, Persona $personas)
    {
        $personas->apellido = strtoupper($request->get('apellido'));
        $personas->nombre = strtoupper($request->get('nombre'));
        $personas->cargo = strtoupper($request->get('cargo'));
        $personas->email = strtolower($request->get('email'));
        $personas->telefono = strtoupper($request->get('telefono'));
        $personas->tipopersonas_id = $request->get('tipopersonas_id');
        $personas->terceros_id = $request->get('terceros_id');
        $bitacoras = new Bitacora;
        $persona = $personas->nombre.' '.$personas->apellido;
        $bitacoras->register($bitacoras, 'U', $persona, $personas->id, 'personas', auth()->user()->id);
        $personas->update();
        session()->flash('message', 'Persona actualizada!');
        return redirect()->route('personas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $personas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $personas)
    {
        try {
            $personas->delete();
            $bitacoras = new Bitacora;
            $persona = $personas->nombre.' '.$personas->apellido;
            $bitacoras->register($bitacoras, 'D', $persona, $personas->id, 'personas', auth()->user()->id);
            session()->flash('message', 'Persona eliminada!');
            return redirect()->route('personas.index');
        }
        catch (\Illuminate\Database\QueryException $e) {
            if($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No puede eliminar persona, posee informaci??n relacionada');
                return redirect()->route('personas.index');
            }
        }
    }
}
