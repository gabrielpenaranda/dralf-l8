<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Bitacora;
use App\Models\Divisa;

class DivisaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $productos = Producto::orderBy('nombre', 'asc')->paginate(10);
        // return view('dralf.productos.index')->with(['productos' => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $productos = new Producto;
        // $unidadmedidas = UnidadMedida::orderBy('unidad', 'asc')->get();
        // $tipoproductos = TipoProducto::orderBy('nombre', 'asc')->get();
        // $prueba = ['NO', 'ANTICOAGULANTE', 'DILUENTE', 'LISANTE', 'RINSE'];
        // $titulo = 'Crear Producto';
        // return view('dralf.productos.form')->with(['productos' => $productos, 'unidadmedidas' => $unidadmedidas, 'tipoproductos' => $tipoproductos, 'prueba' => $prueba, 'titulo' => $titulo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductoRequest $request)
    {
        // $divisas = Divisa::find(1);
        // $productos = new Producto;
        // $productos->codigo = strtoupper($request->get('codigo'));
        // $productos->nombre = strtoupper($request->get('nombre'));
        // $productos->capacidad = strtoupper($request->get('capacidad'));
        // $productos->prueba = strtoupper($request->get('prueba'));
        // $productos->unidadmedidas_id = $request->get('unidadmedidas_id');
        // $productos->tipoproductos_id = $request->get('tipoproductos_id');
        // $productos->preciodolar = $request->get('preciodolar');
        // $productos->precio = $request->get('preciodolar') * $divisas->cambio;
        // $productos->impuesto = $request->get('impuesto');
        // $productos->costo = 0;
        // $productos->save();
        // $bitacoras = new Bitacora;
        // $bitacoras->descripcion = "Crear registro: ".$productos->nombre;
        // $bitacoras->accion = 'C';
        // $bitacoras->tabla = 'productos';
        // $bitacoras->tabla_id = $productos->id;
        // $bitacoras->user_id = auth()->user()->id;
        // $bitacoras->save();
        // session()->flash('message', 'Producto creado con éxito!');
        // return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $productos
     * @return \Illuminate\Http\Response
     */
    public function show($productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $productos
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $productos)
    {
        $divisas = Divisa::find(1);
        $titulo = 'Editar Divisa';
        return view('dralf.divisas.form', compact('divisas', 'titulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $productos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Divisa $divisas)
    {
        $divisas->cambio = (float)$request->get('cambio');
        $divisas->update();
        $bitacoras = new Bitacora;
        $bitacoras->register($bitacoras, 'U', $divisas->nombre, $divisas->id, 'divisas', auth()->user()->id);
        $productos = Producto::all();
        // $productos = DB::table('productos')->get();
        // dd(count($productos));
        $precio = 0;
        $nuevoprecio = 0;
        $cambio = (float)$request->get('cambio');
        foreach($productos as $p)
        {
            $precio = (float)$p->preciodolar;
            $nuevoprecio = $precio * $cambio;
            $p->precio = (float)$nuevoprecio;
            $p->update();
            $bitacoras = new Bitacora;
            $bitacoras->register($bitacoras, 'U', $p->nombre, $p->id, 'productos', auth()->user()->id);
        }
        
        session()->flash('message', 'Precios actualizados!');
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $productos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $productos)
    {
        // try {
        //     $productos->delete();
        //     $bitacoras = new Bitacora;
        //     $bitacoras->descripcion = "Eliminar registro: ".$productos->nombre;
        //     $bitacoras->accion = 'D';
        //     $bitacoras->tabla = 'productos';
        //     $bitacoras->tabla_id = $productos->id;
        //     $bitacoras->user_id = auth()->user()->id;
        //     $bitacoras->save();
        //     session()->flash('message', 'Producto eliminado!');
        //     return redirect()->route('productos.index');
        // }
        // catch (\Illuminate\Database\QueryException $e) {
        //     if($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
        //         session()->flash('warning', 'No puede eliminar producto, posee información relacionada');
        //         return redirect()->route('productos.index');
        //     }
        // }
    }
}
