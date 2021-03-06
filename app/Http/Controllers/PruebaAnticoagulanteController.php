<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePruebaAnticoagulanteRequest;
use App\Http\Requests\UpdatePruebaAnticoagulanteRequest;
use App\Models\PruebaAnticoagulante;
use App\Models\Lote;
use App\Models\Bitacora;

class PruebaAnticoagulanteController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pruebaanticoagulantes = PruebaAnticoagulante::orderBy('lotes_id', 'desc')->paginate(10);
        return view('dralf.pruebaanticoagulantes.index')->with(['pruebaanticoagulantes' => $pruebaanticoagulantes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pruebaanticoagulantes = new PruebaAnticoagulante;
        $lotes = Lote::where('prueba', 'ANTICOAGULANTE')->where('certificado', false)->orderBy('numero', 'desc')->get();
        $titulo = "Crear Prueba Anticoagulante";
        if (count($lotes) == 0)
        {
            session()->flash('warning', 'Debe incluir un lote antes de incluir una prueba');
            return redirect()->route('pruebaanticoagulantes.index');
        }
        return view('dralf.pruebaanticoagulantes.form')->with(['pruebaanticoagulantes' => $pruebaanticoagulantes, 'lotes' => $lotes, 'titulo' => $titulo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePruebaAnticoagulanteRequest $request)
    {
        $pruebaanticoagulantes = new PruebaAnticoagulante;
        $pruebaanticoagulantes->ph = $request->get('ph');
        $pruebaanticoagulantes->tubo = $request->get('tubo');
        $pruebaanticoagulantes->lotes_id = $request->get('lotes_id');
        $pruebaanticoagulantes->numero = '';
        $pruebaanticoagulantes->save();
        $pruebaanticoagulantes->numero = $pruebaanticoagulantes->lotes->numero.'-'.$pruebaanticoagulantes->id;
        $pruebaanticoagulantes->update();
        $bitacoras = new Bitacora;
        $bitacoras->register($bitacoras, 'C', $pruebaanticoagulantes->numero, $pruebaanticoagulantes->id, 'pruebaanticoagulantes', auth()->user()->id);
        session()->flash('message', 'Prueba creada con ??xito!');
        return redirect()->route('pruebaanticoagulantes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $pruebaanticoagulantes
     * @return \Illuminate\Http\Response
     */
    public function show(PruebaAnticoagulante $pruebaanticoagulantes)
    {
        return view('dralf.pruebaanticoagulantes.show')->with(['pruebaanticoagulantes' => $pruebaanticoagulantes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $pruebaanticoagulantes
     * @return \Illuminate\Http\Response
     */
    public function edit(PruebaAnticoagulante $pruebaanticoagulantes)
    {
        $lotes = Lote::all();
        $titulo = "Editar Prueba Anticoagulante";
        return view('dralf.pruebaanticoagulantes.form')->with(['pruebaanticoagulantes' => $pruebaanticoagulantes, 'lotes' => $lotes, 'titulo' => $titulo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $pruebaanticoagulantes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePruebaAnticoagulanteRequest $request, PruebaAnticoagulante $pruebaanticoagulantes)
    {
        // $prueba = $pruebaanticoagulantes->lotes->numero;
        $pruebaanticoagulantes->ph = $request->get('ph');
        $pruebaanticoagulantes->tubo = $request->get('tubo');
        $pruebaanticoagulantes->update();
        $bitacoras = new Bitacora;
        $bitacoras->register($bitacoras, 'U', $pruebaanticoagulantes->numero, $pruebaanticoagulantes->id, 'pruebaanticoagulantes', auth()->user()->id);
        session()->flash('message', 'Prueba actualizada!');
        return redirect()->route('pruebaanticoagulantes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $pruebaanticoagulantes
     * @return \Illuminate\Http\Response
     */
    public function destroy(PruebaAnticoagulante $pruebaanticoagulantes)
    {
       try {
            $pruebaanticoagulantes->delete();
            $bitacoras = new Bitacora;
            $bitacoras->register($bitacoras, 'D', $pruebaanticoagulantes->numero, $pruebaanticoagulantes->id, 'pruebaanticoagulantes', auth()->user()->id);
            session()->flash('message', 'Prueba eliminada!');
            return redirect()->route('pruebaanticoagulantes.index');
        }
        catch (\Illuminate\Database\QueryException $e) {
            if($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No puede eliminar prueba, posee informaci??n relacionada');
                return redirect()->route('pruebaanticoagulantes.index');
            }
        }
    }
}
