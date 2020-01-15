<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePruebaLisanteRequest;
use App\Http\Requests\UpdatePruebaLisanteRequest;
use App\PruebaLisante;
use App\Lote;
use App\Bitacora;

class PruebaLisanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pruebalisantes = PruebaLisante::orderBy('lotes_id', 'desc')->paginate(10);
        return view('dralf.pruebalisantes.index')->with(['pruebalisantes' => $pruebalisantes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pruebalisantes = new PruebaLisante;
        $lotes = Lote::where('prueba', 'LISANTE')->orderBy('numero', 'desc')->get();
        $titulo = "Crear Prueba Lisante";
        if (count($lotes) == 0)
        {
            session()->flash('warning', 'Debe incluir un lote antes de incluir una prueba');
            return redirect()->route('pruebalisantes.index');
        }
        return view('dralf.pruebalisantes.form')->with(['pruebalisantes' => $pruebalisantes, 'lotes' => $lotes, 'titulo' => $titulo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePruebaLisanteRequest $request)
    {
        $pruebalisantes = new PruebaLisante;
        $pruebalisantes->ph = $request->get('ph');
        $pruebalisantes->conductividad = $request->get('conductividad');
        $pruebalisantes->contaje = $request->get('contaje');
        $pruebalisantes->lotes_id = $request->get('lotes_id');
        $pruebalisantes->save();
        $bitacoras = new Bitacora;
        $bitacoras->accion = 'C';
        $bitacoras->descripcion = "Actualizar/Modificar registro: ".$pruebalisantes->lotes->numero;
        $bitacoras->tabla = 'pruebalisantess';
        $bitacoras->tabla_id = $pruebalisantes->id;
        $bitacoras->user_id = auth()->user()->id;
        $bitacoras->save();
        session()->flash('message', 'Prueba creada con éxito!');
        return redirect()->route('pruebalisantes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $pruebalisantes
     * @return \Illuminate\Http\Response
     */
    public function show(PruebaLisante $pruebalisantes)
    {
        return view('dralf.pruebalisantes.show')->with(['pruebalisantes' => $pruebalisantes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $pruebalisantes
     * @return \Illuminate\Http\Response
     */
    public function edit(PruebaLisante $pruebalisantes)
    {
        $lotes = Lote::all();
        $titulo = "Editar Prueba Diluente";
        return view('dralf.pruebalisantes.form')->with(['pruebalisantes' => $pruebalisantes, 'lotes' => $lotes, 'titulo' => $titulo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $pruebalisantes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePruebaLisanteRequest $request, PruebaLisante $pruebalisantes)
    {
        $bitacoras = new Bitacora;
        $pruebalisantes->ph = $request->get('ph');
        $pruebalisantes->conductividad = $request->get('conductividad');
        $pruebalisantes->contaje = $request->get('contaje');
        $bitacoras->descripcion = "Actualizar/Modificar registro: ".$pruebalisantes->lotes->numero;
        $bitacoras->accion = 'U';
        $bitacoras->tabla = 'pruebalisantes';
        $bitacoras->tabla_id = $pruebalisantes->id;
        $bitacoras->user_id = auth()->user()->id;
        $bitacoras->save();
        $pruebalisantes->update();
        session()->flash('message', 'Prueba actualizada!');
        return redirect()->route('pruebalisantes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $pruebalisantes
     * @return \Illuminate\Http\Response
     */
    public function destroy(PruebaLisante $pruebalisantes)
    {
       try {
            $pruebalisantes->delete();
            $bitacoras = new Bitacora;
            $bitacoras->descripcion = "Eliminar registro: ".$pruebalisantes->lotes->numero;
            $bitacoras->accion = 'D';
            $bitacoras->tabla = 'pruebalisantes';
            $bitacoras->tabla_id = $pruebalisantes->id;
            $bitacoras->user_id = auth()->user()->id;
            $bitacoras->save();
            session()->flash('message', 'Prueba eliminada!');
            return redirect()->route('pruebalisantes.index');
        }
        catch (\Illuminate\Database\QueryException $e) {
            if($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No puede eliminar prueba, posee información relacionada');
                return redirect()->route('pruebalisantes.index');
            }
        }
    }
}
