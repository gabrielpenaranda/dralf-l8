<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateTipoPersonaRequest;
use App\Http\Requests\UpdateTipoPersonaRequest;
use App\TipoPersona;
use App\Bitacora;

class TipoPersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipopersonas = TipoPersona::orderBy('nombre', 'asc')->paginate(7);
        return view('dralf.tipopersonas.index')->with(['tipopersonas' => $tipopersonas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipopersonas = new TipoPersona;
        $titulo = 'Crear Tipo Persona';
        return view('dralf.tipopersonas.form')->with(['tipopersonas' => $tipopersonas, 'titulo' => $titulo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTipoPersonaRequest $request)
    {
        $tipopersonas = new TipoPersona;
        $tipopersonas->nombre = strtoupper($request->get('nombre'));
        $tipopersonas->save();
        $bitacoras = new Bitacora;
        $bitacoras->register($bitacoras, 'C', $tipopersonas->numero, $tipopersonas->id, 'tipopersonas', auth()->user()->id);
        session()->flash('message', 'Tipo Persona creado con éxito!');
        return redirect()->route('tipopersonas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $tipopersonas
     * @return \Illuminate\Http\Response
     */
    public function show($tipopersonas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $tipopersonas
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoPersona $tipopersonas)
    {
        $titulo = 'Editar Tipo Persona';
        return view('dralf.tipopersonas.form')->with(['tipopersonas' => $tipopersonas, 'titulo' => $titulo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $tipopersonas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipoPersonaRequest $request, TipoPersona $tipopersonas)
    {
        $tipopersonas->nombre = strtoupper($request->get('nombre'));
        $tipopersonas->update();
        $bitacoras = new Bitacora;
        $bitacoras->register($bitacoras, 'U', $tipopersonas->nombre, $terceros->id, 'terceros', auth()->user()->id);
        session()->flash('message', 'Tipo Persona actualizado!');
        return redirect()->route('tipopersonas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $tipopersonas
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoPersona $tipopersonas)
    {
        try {
            $tipopersonas->delete();
            $bitacoras = new Bitacora;
            $bitacoras->register($bitacoras, 'D', $tipopersonas->nombre, $terceros->id, 'terceros', auth()->user()->id);
            session()->flash('message', 'Tipo Persona eliminado!');
            return redirect()->route('tipopersonas.index');
        }
        catch (\Illuminate\Database\QueryException $e) {
            if($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No puede eliminar el tipo persona, posee información relacionada');
                return redirect()->route('tipopersonas.index');
            }

        }
    }
}
