<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateDepositoRequest;
use App\Http\Requests\UpdateDepositoRequest;
use App\Deposito;
use App\Ciudad;
use App\Bitacora;

class DepositoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $depositos = Deposito::orderBy('nombre', 'asc')->paginate(7);
        return view('dralf.depositos.index')->with(['depositos' => $depositos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $depositos = new Deposito;
        $ciudades = Ciudad::orderBy('nombre', 'asc')->get();
        $titulo = 'Crear Deposito';
        return view('dralf.depositos.form')->with(['depositos' => $depositos, 'ciudades' => $ciudades, 'titulo' => $titulo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDepositoRequest $request)
    {
        $depositos = new Deposito;
        $depositos->nombre = strtoupper($request->get('nombre'));
        $depositos->direccion = strtoupper($request->get('direccion'));
        $depositos->telefono = strtoupper($request->get('telefono'));
        $depositos->ciudades_id = $request->get('ciudades_id');
        $depositos->factura = $request->get('factura');
        $depositos->save();
        $bitacoras = new Bitacora;
        $bitacoras->register($bitacoras, 'C', $depositos->nombre, $depositos->id, 'depositos', auth()->user()->id);
        session()->flash('message', 'Deposito creado con éxito!');
        return redirect()->route('depositos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $depositos
     * @return \Illuminate\Http\Response
     */
    public function show($depositos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $depositos
     * @return \Illuminate\Http\Response
     */
    public function edit(Deposito $depositos)
    {
        $titulo = 'Editar Deposito';
        $ciudades = Ciudad::orderBy('nombre', 'asc')->get();
        return view('dralf.depositos.form')->with(['depositos' => $depositos, 'ciudades' => $ciudades, 'titulo' => $titulo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $depositos
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepositoRequest $request, Deposito $depositos) {
        $depositos->direccion = strtoupper($request->get('direccion'));
        $depositos->telefono = strtoupper($request->get('telefono'));
        $depositos->ciudades_id = $request->get('ciudades_id');
        $depositos->factura = $request->get('factura');
        $bitacoras = new Bitacora;
        $bitacoras->register($bitacoras, 'U', $depositos->nombre, $depositos->id, 'depositos', auth()->user()->id);
        $depositos->update();
        session()->flash('message', 'Deposito actualizado!');
        return redirect()->route('depositos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $depositos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deposito $depositos)
    {
        try {
            $depositos->delete();
            $bitacoras = new Bitacora;
            $bitacoras->register($bitacoras, 'D', $depositos->nombre, $depositos->id, 'depositos', auth()->user()->id);
            session()->flash('message', 'Deposito eliminada!');
            return redirect()->route('depositos.index');
        }
        catch (\Illuminate\Database\QueryException $e) {
            if($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No puede eliminar el deposito, posee información relacionada');
                return redirect()->route('depositos.index');
            }
        }
    }
}
