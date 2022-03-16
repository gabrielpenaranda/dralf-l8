<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePruebaRequest;
use App\Http\Requests\UpdatePruebaRequest;
use App\Models\Prueba;
use App\Models\Lote;

class PruebaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prueba = Prueba::orderBy('lote_id', 'desc')->paginate(10);
        return view('dralf.prueba.index')->with(['prueba' => $prueba]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prueba = new Prueba;
        $lote = Lote::all();
        if (count($lote) == 0)
        {
            session()->flash('warning', 'Debe incluir un lote antes de incluir un prueba');
            return redirect()->route('pruebas.index');
        }
        return view('dralf.prueba.create')->with(['prueba' => $prueba])->with(['lote' => $lote]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePruebaRequest $request)
    {
        $prueba = new Prueba;
        // dd($request->get('ph_prueba'));
        // $ph = floatval($request->get('ph_prueba'));
        // // dd($ph);
        // $ph = number_format($ph, 2, ',', '');
        // dd($ph);
        $prueba->ph_prueba = $request->get('ph_prueba');
        $prueba->conductividad_prueba = $request->get('conductividad_prueba');
        $prueba->plt_1_prueba = $request->get('plt_1_prueba');
        $prueba->plt_2_prueba = $request->get('plt_2_prueba');
        $prueba->plt_3_prueba = $request->get('plt_3_prueba');
        $prueba->plt_4_prueba = $request->get('plt_4_prueba');
        $prueba->plt_5_prueba = $request->get('plt_5_prueba');
        $prueba->lote_id = $request->get('lote_id');
        $prueba->user_id = auth()->user()->id;
        $prueba->save();
        session()->flash('message', 'Prueba creada con éxito!');
        return redirect()->route('pruebas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $prueba
     * @return \Illuminate\Http\Response
     */
    public function show(Prueba $prueba)
    {
        return view('dralf.prueba.show')->with(['prueba' => $prueba]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $prueba
     * @return \Illuminate\Http\Response
     */
    public function edit(Prueba $prueba)
    {
        $lote = Lote::all();
        return view('dralf.prueba.edit')->with(['prueba' => $prueba])->with(['lote' => $lote]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $prueba
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePruebaRequest $request, Prueba $prueba)
    {
        $prueba->user_id = auth()->user()->id;
        $prueba->update($request->only('ph_prueba', 'conductividad_prueba', 'plt_1_prueba', 'plt_2_prueba', 'plt_3_prueba', 'plt_4_prueba', 'plt_5_prueba', 'lote_id', 'user_id'));
        session()->flash('message', 'Prueba actualizada!');
        return redirect()->route('pruebas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $prueba
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prueba $prueba)
    {
        // if ($prueba->detalle_facturas)
        // {
        //     session()->flash('message', 'No puede eliminar el prueba, posee información relacionada');
        //     return redirect()->route('pruebas.index');
        // }
        // else
        // {
        //     $prueba->delete();
        //     session()->flash('message', 'Prueba eliminado!');
        //     return redirect()->route('pruebas.index');
        // }
        $prueba->delete();
        session()->flash('message', 'Prueba eliminada!');
        return redirect()->route('pruebas.index');
    }
}
