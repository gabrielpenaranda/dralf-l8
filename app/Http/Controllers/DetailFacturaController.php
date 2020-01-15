<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateDetalleFacturaRequest;
use App\Http\Requests\UpdateDetalleFacturaRequest;
use App\Factura;
use App\DetalleFactura;
use App\Lote;
use Laracasts\Flash;

class DetailFacturaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @param string $modulo
   * @param  int  $facturas
   * @return \Illuminate\Http\Response
   */
  public function index(Factura $facturas, $modulo)
  {
    $detallefacturas = DetalleFactura::where('facturas_id', $facturas->id)->orderBy('lote_id', 'asc')->paginate(10);
    return view('dralf.detallefacturas.index')->with(['facturas' => $facturas])->with(['detallefacturas' => $detallefacturas])->with(['modulo' => $modulo]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @param string $modulo
   * @param  int  $facturas
   * @return \Illuminate\Http\Response
   */
  public function create(Factura $facturas, $modulo)
  {
    $detallefacturas = new DetalleFactura;
    $lote = Lote::where('cantidad_disponible_lote', '>', '0')->orderBy('fecha_produccion_lote', 'asc')->get();
    // dd($lote);
    return view('dralf.detallefacturas.create')->with(['lote' => $lote])->with(['facturas' => $facturas])->with(['detallefacturas' => $detallefacturas])->with(['modulo' => $modulo]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param string $modulo
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreateDetalleFacturaRequest $request, $modulo)
  {
    $lote = Lote::where('id', $request->get('lote_id'))->first();
    echo $lote->id;
    // dd($lote);

    if ($request->get('cantidad_detalle_facturas') > $lote->cantidad_disponible_lote) {
      session()->flash('error', 'Cantidad es mayor a la disponible')->error()->important();
      if ($modulo == 'facturas') {
        return redirect()->route('facturass.index', ['modulo' => $modulo]);
      } else {
        return redirect()->route('notaentrega.index', ['modulo' => $modulo]);
      }
    } else {
      $lote->cantidad_disponible_lote -= $request->get('cantidad_detalle_facturas');
      $lote->update();
    }
    $detallefacturas = new DetalleFactura;
    $detallefacturas->cantidad_detalle_facturas = $request->get('cantidad_detalle_facturas');
    $detallefacturas->resto_detalle_facturas = $request->get('cantidad_detalle_facturas');
    $detallefacturas->lote_id = $request->get('lote_id');
    $detallefacturas->facturas_id = $request->get('facturas_id');
    $detallefacturas->user_id = auth()->user()->id;
    $detallefacturas->save();
    session()->flash('message', 'Item de facturas creado con éxito!');
    if ($modulo == 'facturas') {
      return redirect()->route('facturass.index', ['modulo' => $modulo]);
    }
    else
    {
      return redirect()->route('notaentrega.index', ['modulo' => $modulo]);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param string $modulo
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $modulo)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
