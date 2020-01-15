<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCiudadRequest;
use App\Http\Requests\UpdateCiudadRequest;
use App\Ciudad;
use App\Estado;
use App\Bitacora;

class CiudadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciudades = Ciudad::orderBy('nombre', 'asc')->paginate(7);
        return view('dralf.ciudades.index')->with(['ciudades' => $ciudades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ciudades = new Ciudad;
        $estados = Estado::orderBy('nombre', 'asc')->get();
        $titulo = 'Crear Ciudad';
        return view('dralf.ciudades.form')->with(['ciudades' => $ciudades, 'estados' => $estados, 'titulo' => $titulo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCiudadRequest $request)
    {
        $ciudades = new Ciudad;
        $ciudades->nombre = strtoupper($request->get('nombre'));
        $ciudades->estados_id = $request->get('estados_id');
        $ciudades->save();
        $bitacoras = new Bitacora;
        $bitacoras->descripcion = "Crear registro: ".$ciudades->nombre;
        $bitacoras->accion = 'C';
        $bitacoras->tabla = 'ciudades';
        $bitacoras->tabla_id = $ciudades->id;
        $bitacoras->user_id = auth()->user()->id;
        $bitacoras->save();
        session()->flash('message', 'Ciudad creada con éxito!');
        return redirect()->route('ciudades.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $ciudades
     * @return \Illuminate\Http\Response
     */
    public function show($ciudades)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $ciudades
     * @return \Illuminate\Http\Response
     */
    public function edit(Ciudad $ciudades)
    {
        $titulo = 'Editar Ciudad';
        $estados = Estado::orderBy('nombre', 'asc')->get();
        return view('dralf.ciudades.form')->with(['ciudades' => $ciudades, 'estados' => $estados, 'titulo' => $titulo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $ciudades
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCiudadRequest $request, Ciudad $ciudades) {
        $ciudades->nombre = strtoupper($request->get('nombre'));
        $ciudades->estados_id = $request->get('estados_id');
        $bitacoras = new Bitacora;
        $bitacoras->descripcion = "Actualizar/Modificar registro: ".$ciudades->nombre;
        $bitacoras->accion = 'U';
        $bitacoras->tabla = 'ciudades';
        $bitacoras->tabla_id = $ciudades->id;
        $bitacoras->user_id = auth()->user()->id;
        $bitacoras->save();
        $ciudades->update();
        session()->flash('message', 'Ciudad actualizada!');
        return redirect()->route('ciudades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $ciudades
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ciudad $ciudades)
    {
        try {
            $ciudades->delete();
            $bitacoras = new Bitacora;
            $bitacoras->descripcion = "Eliminar registro: ".$ciudades->nombre;
            $bitacoras->accion = 'D';
            $bitacoras->tabla = 'ciudades';
            $bitacoras->tabla_id = $ciudades->id;
            $bitacoras->user_id = auth()->user()->id;
            $bitacoras->save();
            session()->flash('message', 'Ciudad eliminada!');
            return redirect()->route('ciudades.index');
        }
        catch (\Illuminate\Database\QueryException $e) {
            if($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No puede eliminar la ciudad, posee información relacionada');
                return redirect()->route('ciudades.index');
            }
        }
    }
}
