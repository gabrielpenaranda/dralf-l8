<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateNotaEntregaRequest;
use App\Http\Requests\UpdateNotaEntregaRequest;
use App\Factura;
use App\DetalleFactura;
use App\Tercero;
use App\Producto;
use App\Lote;
use App\Correlativo;

class NotaEntregaController extends Controller
{
    /**
   * Display a listing of the resource.
   *
   * @param string $modulo
   * @return \Illuminate\Http\Response
   */
  public function index($modulo)
  {
    $facturas = Factura::where('documento', '=', 'notaentrega')->orderBy('numero', 'desc')->paginate(10);
    return view('dralf.facturas.index')->with(['facturas' => $facturas, 'modulo' => $modulo]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @param string $modulo
   * @return \Illuminate\Http\Response
   */
  public function create($modulo)
  {
    $facturas = new Factura;
    $terceros = Tercero::orderBy('nombre', 'asc')->get();
    $titulo = "Generar Nota de Entrega";
    $lote = Lote::where('cantidad_disponible', '>', 0)->orderBy('numero', 'asc')->get();
    if (count($lote) == 0)
    {
      session()->flash('warning', 'Debe incluir un lote antes de incluir una nota de entrega');
      return redirect()->route('facturas.index', ['modulo' => $modulo]);
    }
    else if (count($terceros) == 0)
    {
      session()->flash('warning', 'Debe incluir un terceros antes de incluir una nota de entrega');
      return redirect()->route('facturas.index', ['modulo' => $modulo]);
    }
    return view('dralf.facturas.form')->with(['facturas' => $facturas, 'terceros' => $terceros, 'modulo' => $modulo, 'titulo' => $titulo]);
  }

  /**
   * Store a newly created resource in storage.
   * 
   * @param string $modulo
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function ftercero(Request $request, $modulo)
  {
    $terceros = DB::table('terceros')->where('id', $request->get('terceros_id'))->first();
    $productos = Lote::where('cantidad_disponible', '>', 0)->orderBy('productos_id', 'asc')->get();
    $fproductos = "null";
    $titulo = "Generar Nota de Entrega";
    $facturas = new Factura;
    $facturas->numero = 'pendiente';
    $facturas->fecha = date('Y-m-d');
    $facturas->monto = 0;
    $facturas->saldo = 0;
    $facturas->iva = 0;
    $facturas->documento = $modulo;
    $facturas->terceros_id = $terceros->id;
    $facturas->save();
    return view('dralf.facturas.detalle')->with(['productos' => $productos, 'terceros' => $terceros, 'modulo' => $modulo, 'fproductos' => $fproductos, 'facturas' => $facturas, 'titulo' => $titulo]);
  }

  /**
   * Store a newly created resource in storage.
   * 
   * @param string $modulo
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function freverse(Request $request, Factura $facturas, $modulo)
  {
    $facturas->delete();
    return redirect()->route('facturas.index', ['modulo' => $modulo]);
  }

  /**
   * Store a newly created resource in storage.
   * 
   * @param string $modulo
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function fdestroy(Request $request, Factura $facturas, $modulo)
  {
    $detallefacturas = DetalleFactura::where('facturas_id', $facturas->id)->get();
    foreach($detallefacturas as $df) {
      $lote = Lote::find($df->lotes_id);
      $lote->cantidad_disponible = $lote->cantidad_disponible + $df->cantidad;
      $lote->update();
      $df->delete();
    }
    $facturas->delete();
    return redirect()->route('facturas.index', ['modulo' => $modulo]);
  }

  /**
   * Store a newly created resource in storage.
   * 
   * @param string $modulo
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function fproducto(Request $request, $terceros,Factura $facturas, $modulo)
  {
    $terceros = DB::table('terceros')->where('id', $terceros)->first();
   
    $lote = Lote::where('id', $request->get('lotes_id'))->first();
    // dd($lote);
    if ($lote->cantidad_disponible >= $request->get('cantidad')) {
      $lote->cantidad_disponible = $lote->cantidad_disponible - $request->get('cantidad');
      $lote->update();

      $detallefacturas = new DetalleFactura;
      $detallefacturas->cantidad = $request->get('cantidad');
      $detallefacturas->resto = $request->get('cantidad');
      $detallefacturas->facturas_id = $facturas->id;
      $detallefacturas->lotes_id = $request->get('lotes_id');
      $detallefacturas->save();
      
    }
    else {
      session()->flash('warning', 'Cantidad señalada es mayor a la disponible');
    }
    $fproductos = DetalleFactura::where('facturas_id', $facturas->id)->paginate(10);
    $titulo = "Generar Nota de Entrega";
    $facturas = DB::table('facturas')->where('id', $detallefacturas->facturas_id)->first();
    $productos = Lote::where('cantidad_disponible', '>', 0)->orderBy('productos_id', 'asc')->get();
    // dd($terceros);
    return view('dralf.facturas.detalle')->with(['productos' => $productos, 'terceros' => $terceros, 'modulo' => $modulo, 'fproductos' => $fproductos, 'facturas' => $facturas, 'titulo' => $titulo]);
  }

  /**
   * Store a newly created resource in storage.
   * 
   * @param string $modulo
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function fproductodestroy(Request $request, $terceros, Factura $facturas, DetalleFactura $detalle, $modulo)
  {
    $terceros = DB::table('terceros')->where('id', $terceros)->first();
    $lote = Lote::find($detalle->lotes_id);
    $lote->cantidad_disponible = $lote->cantidad_disponible + $detalle->cantidad;
    $lote->update();
    $detalle->delete();
    $fproductos = DetalleFactura::where('facturas_id', $facturas->id)->paginate(10);
    $facturas = DB::table('facturas')->where('id', $facturas->id)->first();
    $productos = Lote::where('cantidad_disponible', '>', 0)->orderBy('productos_id', 'asc')->get();
    $titulo = "Generar Nota de Entrega";
    session()->flash('message', 'Producto quitado con éxito');
    return view('dralf.facturas.detalle')->with(['productos' => $productos, 'terceros' => $terceros, 'modulo' => $modulo, 'fproductos' => $fproductos, 'facturas' => $facturas, 'titulo' => $titulo]);
    // return redirect()->route('facturas.index', ['modulo' => $modulo]);
  }

  /**
   * Store a newly created resource in storage.
   * 
   * @param string $modulo
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function fstore(Request $request, $terceros, Factura $facturas, $modulo)
  {
    $productos = Lote::where('cantidad_disponible', '>', 0)->orderBy('productos_id', 'asc')->get();
    $correlativo = Correlativo::where('documento', 'FACTURA')->first();
    $correlativo->correlativo = $correlativo->correlativo + 1;
    $correlativo->update();
    $facturas->numero = $correlativo->correlativo;
    $facturas->update();
    $titulo = "Ver/Imprimir Nota de Entrega";
    session()->flash('message', 'Nota de Entrega generada con éxito');
    $detallefacturas = DetalleFactura::where('facturas_id', $facturas->id)->orderBy('lotes_id', 'asc')->get();
    // dd($detallefacturas);
    return view('dralf.facturas.show')->with(['facturas' => $facturas, 'detallefacturas'=> $detallefacturas, 'modulo' => $modulo]);
  }

  //*********************************************************************************************


  /**
   * Store a newly created resource in storage.
   * 
   * @param string $modulo
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreateFacturaRequest $request, $modulo)
  {
    $fecha = date('Y-m-d');
    $facturas = new Factura;
    $facturas->numero = $request->get('numero');
    $facturas->fecha = $fecha;
    $facturas->monto = $request->get('monto');
    $facturas->saldo = $request->get('monto') + $request->get('iva');
    $facturas->documento = $modulo;
    $facturas->iva = $request->get('iva');
    $facturas->terceros_id = $request->get('terceros_id');
    $facturas->save();
    session()->flash('message', 'Factura creado con éxito!');
    return redirect()->route('facturas.index', ['modulo' => $modulo]);
  }

  /**
   * Display the specified resource.
   *
   * @param string $modulo
   * @param  int  $facturas
   * @return \Illuminate\Http\Response
   */
  public function show(Factura $facturas, $modulo)
  {
    $detallefacturas = DetalleFactura::where('facturas_id', $facturas->id)->orderBy('lotes_id', 'asc')->paginate(10);
    return view('dralf.facturas.show')->with(['facturas' => $facturas])->with(['detallefacturas'=> $detallefacturas])->with(['modulo' => $modulo]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $facturas
   * @return \Illuminate\Http\Response
   */
  public function edit(Factura $facturas)
  {
    $lote = Producto::all();

    return view('dralf.facturas.form')->with(['facturas' => $facturas])->with(['lote' => $lote]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $facturas
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateFacturaRequest $request, Factura $facturas)
  {
    $fecha = date("Y-m-d", strtotime($request->get('fecha')));
    $facturas->fecha = $fecha;
    $facturas->monto = $request->get('monto');
    $facturas->terceros_id = $request->get('terceros_id');
    $facturas->user_id = auth()->user()->id;
    $facturas->update();
    session()->flash('message', 'Factura actualizado!');
    return redirect()->route('facturas.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $facturas
   * @return \Illuminate\Http\Response
   */
  public function destroy(Factura $facturas)
  {
    if (($facturas->entregas->count() > 0) || ($facturas->pagos->count() > 0))
    {
      session()->flash('error', 'No puede eliminar el facturas, posee información relacionada');
      return redirect()->route('facturas.index');
    }
    else
    {
      $facturas->delete();
      session()->flash('message', 'Factura eliminada!');
      return redirect()->route('facturas.index');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $facturas
   * @return \Illuminate\Http\Response
   */
  public function detailIndex(Factura $facturas)
  {
    $detalle = DetalleFactura::where('facturas_id', $facturas->id)->orderBy('lote_id', 'asc')->paginate(10);
    return view('dralf.detalleFactura.index')->with(['facturas' => $facturas])->with(['detalle' => $detalle]);
  }
}