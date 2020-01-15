<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateEstadoRequest;
use App\Http\Requests\UpdateEstadoRequest;
use App\Estado;
use App\Bitacora;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados = Estado::orderBy('nombre', 'asc')->paginate(7);
        return view('dralf.estados.index')->with(['estados' => $estados]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = new Estado;
        $titulo = 'Crear Estado';
        return view('dralf.estados.form')->with(['estados' => $estados, 'titulo' => $titulo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEstadoRequest $request)
    {
        $estados = new Estado;
        $estados->nombre = strtoupper($request->get('nombre'));
        $estados->save();
        $bitacoras = new Bitacora;
        $bitacoras->descripcion = "Crear registro: ".$estados->nombre;
        $bitacoras->accion = 'C';
        $bitacoras->tabla = 'estados';
        $bitacoras->tabla_id = $estados->id;
        $bitacoras->user_id = auth()->user()->id;
        $bitacoras->save();
        session()->flash('message', 'Estado creado con éxito!');
        return redirect()->route('estados.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $estados
     * @return \Illuminate\Http\Response
     */
    public function show($estados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $estados
     * @return \Illuminate\Http\Response
     */
    public function edit(Estado $estados)
    {
        $titulo = 'Editar Estado';
        return view('dralf.estados.form')->with(['estados' => $estados, 'titulo' => $titulo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $estados
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEstadoRequest $request, Estado $estados)
    {
        $estados->nombre = strtoupper($request->get('nombre'));
        $estados->update();
        $bitacoras = new Bitacora;
        $bitacoras->descripcion = "Actualizar/Modificar registro: ".$estados->nombre;
        $bitacoras->accion = "U";
        $bitacoras->user_id = auth()->user()->id;
        $bitacoras->tabla = 'estados';
        $bitacoras->tabla_id = $estados->id;
        $bitacoras->save();
        session()->flash('message', 'Estado actualizado!');
        return redirect()->route('estados.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $estados
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estado $estados)
    {
        try {
            $estados->delete();
            $bitacoras = new Bitacora;
            $bitacoras->descripcion = "Eliminar registro: ".$estados->nombre;
            $bitacoras->accion = 'D';
            $bitacoras->tabla = 'estados';
            $bitacoras->tabla_id = $estados->id;
            $bitacoras->user_id = auth()->user()->id;
            $bitacoras->save();
            session()->flash('message', 'Estado eliminado!');
            return redirect()->route('estados.index');
        }
        catch (\Illuminate\Database\QueryException $e) {
            if($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No puede eliminar el estado, posee información relacionada');
                return redirect()->route('estados.index');
            }

        }
    }
}
