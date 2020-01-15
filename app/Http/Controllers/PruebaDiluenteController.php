<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePruebaDiluenteRequest;
use App\Http\Requests\UpdatePruebaDiluenteRequest;
use App\PruebaDiluente;
use App\Lote;
use App\Bitacora;

class PruebaDiluenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pruebadiluentes = PruebaDiluente::orderBy('lotes_id', 'desc')->paginate(10);
        return view('dralf.pruebadiluentes.index')->with(['pruebadiluentes' => $pruebadiluentes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pruebadiluentes = new PruebaDiluente;
        $lotes = Lote::where('prueba', 'DILUENTE')->orderBy('numero', 'desc')->get();
        $titulo = "Crear Prueba Diluente";
        if (count($lotes) == 0)
        {
            session()->flash('warning', 'Debe incluir un lote antes de incluir una prueba');
            return redirect()->route('pruebadiluentes.index');
        }
        return view('dralf.pruebadiluentes.form')->with(['pruebadiluentes' => $pruebadiluentes, 'lotes' => $lotes, 'titulo' => $titulo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePruebaDiluenteRequest $request)
    {
        $pruebadiluentes = new PruebaDiluente;
        $pruebadiluentes->ph = $request->get('ph');
        $pruebadiluentes->conductividad = $request->get('conductividad');
        $pruebadiluentes->plt_1 = $request->get('plt_1');
        $pruebadiluentes->plt_2 = $request->get('plt_2');
        $pruebadiluentes->plt_3 = $request->get('plt_3');
        $pruebadiluentes->plt_4 = $request->get('plt_4');
        $pruebadiluentes->plt_5 = $request->get('plt_5');
        $pruebadiluentes->lotes_id = $request->get('lotes_id');
        $pruebadiluentes->save();
        $bitacoras = new Bitacora;
        $bitacoras->accion = 'C';
        $bitacoras->descripcion = "Actualizar/Modificar registro: ".$pruebadiluentes->lotes->numero;
        $bitacoras->tabla = 'pruebadiluentess';
        $bitacoras->tabla_id = $pruebadiluentes->id;
        $bitacoras->user_id = auth()->user()->id;
        $bitacoras->save();
        session()->flash('message', 'Prueba creada con éxito!');
        return redirect()->route('pruebadiluentes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $pruebadiluentes
     * @return \Illuminate\Http\Response
     */
    public function show(PruebaDiluente $pruebadiluentes)
    {
        return view('dralf.pruebadiluentes.show')->with(['pruebadiluentes' => $pruebadiluentes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $pruebadiluentes
     * @return \Illuminate\Http\Response
     */
    public function edit(PruebaDiluente $pruebadiluentes)
    {
        $lotes = Lote::all();
        $titulo = "Editar Prueba Diluente";
        return view('dralf.pruebadiluentes.form')->with(['pruebadiluentes' => $pruebadiluentes, 'lotes' => $lotes, 'titulo' => $titulo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $pruebadiluentes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePruebaDiluenteRequest $request, PruebaDiluente $pruebadiluentes)
    {
        $bitacoras = new Bitacora;
        $pruebadiluentes->ph = $request->get('ph');
        $pruebadiluentes->conductividad = $request->get('conductividad');
        $pruebadiluentes->plt_1 = $request->get('plt_1');
        $pruebadiluentes->plt_2 = $request->get('plt_2');
        $pruebadiluentes->plt_3 = $request->get('plt_3');
        $pruebadiluentes->plt_4 = $request->get('plt_4');
        $pruebadiluentes->plt_5 = $request->get('plt_5');
        $bitacoras->descripcion = "Actualizar/Modificar registro: ".$pruebadiluentes->lotes->numero;
        $bitacoras->accion = 'U';
        $bitacoras->tabla = 'pruebadiluentes';
        $bitacoras->tabla_id = $pruebadiluentes->id;
        $bitacoras->user_id = auth()->user()->id;
        $bitacoras->save();
        $pruebadiluentes->update();
        session()->flash('message', 'Prueba actualizada!');
        return redirect()->route('pruebadiluentes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $pruebadiluentes
     * @return \Illuminate\Http\Response
     */
    public function destroy(PruebaDiluente $pruebadiluentes)
    {
       try {
            $pruebadiluentes->delete();
            $bitacoras = new Bitacora;
            $bitacoras->descripcion = "Eliminar registro: ".$pruebadiluentes->lotes->numero;
            $bitacoras->accion = 'D';
            $bitacoras->tabla = 'pruebadiluentes';
            $bitacoras->tabla_id = $pruebadiluentes->id;
            $bitacoras->user_id = auth()->user()->id;
            $bitacoras->save();
            session()->flash('message', 'Prueba eliminada!');
            return redirect()->route('pruebadiluentes.index');
        }
        catch (\Illuminate\Database\QueryException $e) {
            if($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No puede eliminar prueba, posee información relacionada');
                return redirect()->route('pruebadiluentes.index');
            }
        }
    }
}
