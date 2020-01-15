<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUnidadMedidaRequest;
use App\Http\Requests\UpdateUnidadMedidaRequest;
use App\UnidadMedida;
use App\Bitacora;

class UnidadMedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidadmedidas = UnidadMedida::orderBy('unidad', 'asc')->paginate(7);
        return view('dralf.unidadmedidas.index')->with(['unidadmedidas' => $unidadmedidas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidadmedidas = new UnidadMedida;
        $titulo = 'Crear Unidad de Medida';
        return view('dralf.unidadmedidas.form')->with(['unidadmedidas' => $unidadmedidas, 'titulo' => $titulo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUnidadMedidaRequest $request)
    {
        $unidadmedidas = new UnidadMedida;
        $unidadmedidas->unidad = strtoupper($request->get('unidad'));
        $unidadmedidas->abreviatura = strtoupper($request->get('abreviatura'));
        $unidadmedidas->save();
        $bitacoras = new Bitacora;
        $bitacoras->descripcion = "Crear registro: ".$unidadmedidas->unidad;
        $bitacoras->accion = 'C';
        $bitacoras->tabla = 'unidadmedidas';
        $bitacoras->tabla_id = $unidadmedidas->id;
        $bitacoras->user_id = auth()->user()->id;
        $bitacoras->save();
        session()->flash('message', 'Unidad de Medida creado con éxito!');
        return redirect()->route('unidadmedidas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $unidadmedidas
     * @return \Illuminate\Http\Response
     */
    public function show($unidadmedidas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $unidadmedidas
     * @return \Illuminate\Http\Response
     */
    public function edit(UnidadMedida $unidadmedidas)
    {
        $titulo = 'Editar Unidad de Medida';
        return view('dralf.unidadmedidas.form')->with(['unidadmedidas' => $unidadmedidas, 'titulo' => $titulo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $unidadmedidas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnidadMedidaRequest $request, UnidadMedida $unidadmedidas)
    {
        $unidadmedidas->unidad = strtoupper($request->get('unidad'));
        $unidadmedidas->abreviatura = strtoupper($request->get('abreviatura'));
        $unidadmedidas->update();
        $bitacoras = new Bitacora;
        $bitacoras->descripcion = "Actualizar/Modificar registro: ".$unidadmedidas->unidad;
        $bitacoras->accion = 'U';
        $bitacoras->user_id = auth()->user()->id;
        $bitacoras->tabla = 'unidadmedidas';
        $bitacoras->tabla_id = $unidadmedidas->id;
        $bitacoras->save();
        session()->flash('message', 'Unidad de Medida actualizado!');
        return redirect()->route('unidadmedidas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $unidadmedidas
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnidadMedida $unidadmedidas)
    {
        try {
            $unidadmedidas->delete();
            $bitacoras = new Bitacora;
            $bitacoras->descripcion = "Eliminar registro: ".$unidadmedidas->unidad;
            $bitacoras->accion = 'E';
            $bitacoras->tabla = 'unidadmedidas';
            $bitacoras->tabla_id = $unidadmedidas->id;
            $bitacoras->user_id = auth()->user()->id;
            $bitacoras->save();
            session()->flash('message', 'Unidad de Medida eliminada!');
            return redirect()->route('unidadmedidas.index');
        }
        catch (\Illuminate\Database\QueryException $e) {
            if($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No puede eliminar la unidad de medida, posee información relacionada');
                return redirect()->route('unidadmedidas.index');
            }

        }
    }
}
