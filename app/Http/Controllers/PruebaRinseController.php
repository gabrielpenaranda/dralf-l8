<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePruebaRinseRequest;
use App\Http\Requests\UpdatePruebaRinseRequest;
use App\PruebaRinse;
use App\Lote;
use App\Bitacora;

class PruebaRinseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pruebarinses = PruebaRinse::orderBy('lotes_id', 'desc')->paginate(10);
        return view('dralf.pruebarinses.index')->with(['pruebarinses' => $pruebarinses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pruebarinses = new PruebaRinse;
        $lotes = Lote::where('prueba', 'RINSE')->orderBy('numero', 'desc')->get();
        $titulo = "Crear Prueba Lisante";
        if (count($lotes) == 0)
        {
            session()->flash('warning', 'Debe incluir un lote antes de incluir una prueba');
            return redirect()->route('pruebarinses.index');
        }
        return view('dralf.pruebarinses.form')->with(['pruebarinses' => $pruebarinses, 'lotes' => $lotes, 'titulo' => $titulo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePruebaRinseRequest $request)
    {
        $pruebarinses = new PruebaRinse;
        $pruebarinses->ph = $request->get('ph');
        $pruebarinses->conductividad = $request->get('conductividad');
        $pruebarinses->lotes_id = $request->get('lotes_id');
        $pruebarinses->save();
        $bitacoras = new Bitacora;
        $bitacoras->accion = 'C';
        $bitacoras->descripcion = "Actualizar/Modificar registro: ".$pruebarinses->lotes->numero;
        $bitacoras->tabla = 'pruebarinsess';
        $bitacoras->tabla_id = $pruebarinses->id;
        $bitacoras->user_id = auth()->user()->id;
        $bitacoras->save();
        session()->flash('message', 'Prueba creada con éxito!');
        return redirect()->route('pruebarinses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $pruebarinses
     * @return \Illuminate\Http\Response
     */
    public function show(PruebaRinse $pruebarinses)
    {
        return view('dralf.pruebarinses.show')->with(['pruebarinses' => $pruebarinses]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $pruebarinses
     * @return \Illuminate\Http\Response
     */
    public function edit(PruebaRinse $pruebarinses)
    {
        $lotes = Lote::all();
        $titulo = "Editar Prueba Diluente";
        return view('dralf.pruebarinses.form')->with(['pruebarinses' => $pruebarinses, 'lotes' => $lotes, 'titulo' => $titulo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $pruebarinses
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePruebaRinseRequest $request, PruebaRinse $pruebarinses)
    {
        $bitacoras = new Bitacora;
        $pruebarinses->ph = $request->get('ph');
        $pruebarinses->conductividad = $request->get('conductividad');
        $bitacoras->descripcion = "Actualizar/Modificar registro: ".$pruebarinses->lotes->numero;
        $bitacoras->accion = 'U';
        $bitacoras->tabla = 'pruebarinses';
        $bitacoras->tabla_id = $pruebarinses->id;
        $bitacoras->user_id = auth()->user()->id;
        $bitacoras->save();
        $pruebarinses->update();
        session()->flash('message', 'Prueba actualizada!');
        return redirect()->route('pruebarinses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $pruebarinses
     * @return \Illuminate\Http\Response
     */
    public function destroy(PruebaRinse $pruebarinses)
    {
       try {
            $pruebarinses->delete();
            $bitacoras = new Bitacora;
            $bitacoras->descripcion = "Eliminar registro: ".$pruebarinses->lotes->numero;
            $bitacoras->accion = 'D';
            $bitacoras->tabla = 'pruebarinses';
            $bitacoras->tabla_id = $pruebarinses->id;
            $bitacoras->user_id = auth()->user()->id;
            $bitacoras->save();
            session()->flash('message', 'Prueba eliminada!');
            return redirect()->route('pruebarinses.index');
        }
        catch (\Illuminate\Database\QueryException $e) {
            if($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No puede eliminar prueba, posee información relacionada');
                return redirect()->route('pruebarinses.index');
            }
        }
    }
}
