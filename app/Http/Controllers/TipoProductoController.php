<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateTipoProductoRequest;
use App\Http\Requests\UpdateTipoProductoRequest;
use App\Models\TipoProducto;
use App\Models\Bitacora;

class TipoProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoproductos = TipoProducto::orderBy('nombre', 'asc')->paginate(7);
        return view('dralf.tipoproductos.index')->with(['tipoproductos' => $tipoproductos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoproductos = new TipoProducto;
        $titulo = 'Crear Tipo Producto';
        return view('dralf.tipoproductos.form')->with(['tipoproductos' => $tipoproductos, 'titulo' => $titulo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTipoProductoRequest $request)
    {
        $tipoproductos = new TipoProducto;
        $tipoproductos->nombre = strtoupper($request->get('nombre'));
        $tipoproductos->save();
        $bitacoras = new Bitacora;
        $bitacoras->register($bitacoras, 'C', $tipoproductos->nombre, $tipoproductos->id, 'tipoproductos', auth()->user()->id);
        session()->flash('message', 'Tipo Producto creado con éxito!');
        return redirect()->route('tipoproductos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $tipoproductos
     * @return \Illuminate\Http\Response
     */
    public function show($tipoproductos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $tipoproductos
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoProducto $tipoproductos)
    {
        $titulo = 'Editar Tipo Producto';
        return view('dralf.tipoproductos.form')->with(['tipoproductos' => $tipoproductos, 'titulo' => $titulo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $tipoproductos
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipoProductoRequest $request, TipoProducto $tipoproductos)
    {
        $tipoproductos->nombre = strtoupper($request->get('nombre'));
        $tipoproductos->update();
        $bitacoras = new Bitacora;
        $bitacoras->register($bitacoras, 'U', $tipoproductos->nombre, $tipoproductos->id, 'tipoproductos', auth()->user()->id);
        session()->flash('message', 'TipoProducto actualizado!');
        return redirect()->route('tipoproductos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $tipoproductos
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoProducto $tipoproductos)
    {
        try {
            $tipoproductos->delete();
            $bitacoras = new Bitacora;
            $bitacoras->register($bitacoras, 'D', $tipoproductos->nombre, $tipoproductos->id, 'tipoproductos', auth()->user()->id);
            session()->flash('message', 'Tipo Producto eliminado!');
            return redirect()->route('tipoproductos.index');
        }
        catch (\Illuminate\Database\QueryException $e) {
            if($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No puede eliminar el tipo Producto, posee información relacionada');
                return redirect()->route('tipoproductos.index');
            }

        }
    }
}
