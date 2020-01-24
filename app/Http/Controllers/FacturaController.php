<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateFacturaRequest;
use App\Http\Requests\UpdateFacturaRequest;
use App\Factura;
use App\DetalleFactura;
use App\Tercero;
use App\Producto;
use App\Lote;
use App\Correlativo;
use App\Bitacora;
use Fpdf;

class FacturaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @param string $modulo
   * @return \Illuminate\Http\Response
   */
  public function index($modulo)
  {
    // Elimina facturas no generadas, con numero 0 y devuelve existencia a lote
    $eliminar = Factura::where('numero', 0)->get();
    $ec = $eliminar->count();
    foreach($eliminar as $e)
    {
      $eliminardetalle = DetalleFactura::where('facturas_id', $e->id)->get();
        foreach($eliminardetalle as $ed)
        {
          $lote = Lote::where('id', $ed->lotes_id)->first();
          $lote->cantidad_disponible += $ed->cantidad;
          $lote->update();
          $ed->delete();
        }
      $e->delete();
    }
    // 
    if ($modulo == "factura")
    {
      $facturas = Factura::where('documento', '=', 'factura')->orderBy('numero', 'desc')->paginate(10);
    }
    else
    {
      $facturas = Factura::where('documento', '=', 'notaentrega')->orderBy('numero', 'desc')->paginate(10);
    }
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
    $terceros = Tercero::where('cliente', 1)->orderBy('nombre', 'asc')->get();
    if ($modulo == "factura")
    {
      $titulo = "Generar Factura";
    }
    else
    {
      $titulo = "Generar Nota de Entrega";
    }
    $lote = Lote::where('cantidad_disponible', '>', 0)->orderBy('numero', 'asc')->get();
    if (count($lote) == 0)
    {
      session()->flash('warning', 'Debe incluir un lote antes de incluir un documento');
      return redirect()->route('facturas.index', ['modulo' => $modulo]);
    }
    else if (count($terceros) == 0)
    {
      session()->flash('warning', 'Debe incluir un tercero antes de incluir un documento');
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
    $productos = Lote::where('certificado', true)->where('cantidad_disponible', '>', 0)->orderBy('productos_id', 'asc')->get();
    $fproductos = "null";
    if ($modulo == "factura")
    {
      $titulo = "Generar Factura";
    }
    else
    {
      $titulo = "Generar Nota de Entrega";
    }
    $facturas = new Factura;
    $facturas->numero = 0;
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
      if ($request->get('precio') == 0)
      {
        $detallefacturas->precio = $lote->productos->precio;
      }
      else
      {
        $detallefacturas->precio = $request->get('precio');
      }
      // dd($lote->productos->impuesto);
      if ($modulo == "factura")
      {
        if ($lote->productos->impuesto == 1){
          if ($request->get('precio') == 0)
          {
            $detallefacturas->impuesto = $lote->productos->precio * 0.16;
          }
          else
          {
            $detallefacturas->impuesto = $request->get('precio') * 0.16;
          }
        }
        else
        {
          $detallefacturas->impuesto = 0;
        }
      }
      else
      {
        $detallefacturas->impuesto = 0;
      }
      $detallefacturas->resto = $request->get('cantidad');
      $detallefacturas->facturas_id = $facturas->id;
      $detallefacturas->preciousd = $lote->productos->preciodolar;
      $detallefacturas->lotes_id = $request->get('lotes_id');
      $detallefacturas->costo = $lote->productos->costo;
      $detallefacturas->save();
      
      $fproductos = DetalleFactura::where('facturas_id', $facturas->id)->paginate(20);
    }
    else {
      session()->flash('warning', 'Cantidad señalada es mayor a la disponible');
      $fproductos = "null";
    }
    if ($modulo == "factura")
    {
      $titulo = "Generar Factura";
    }
    else
    {
      $titulo = "Generar Nota de Entrega";
    }
    //$facturas = DB::table('facturas')->where('id', $fproductos->facturas_id)->first();
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
    if ($modulo == "factura")
    {
      $titulo = "Generar Factura";
    }
    else
    {
      $titulo = "Generar Nota de Entrega";
    }
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
    $detallefacturas = DetalleFactura::where('facturas_id', $facturas->id)->orderBy('lotes_id', 'asc')->get();
    $monto = 0;
    $impuesto = 0;
    foreach($detallefacturas as $d)
    {
      $monto = $monto + ($d->precio * $d->cantidad);
      $impuesto = $impuesto +($d->impuesto * $d->cantidad);
    }
     if ($modulo == "factura")
    {
      $titulo = "Generar Factura";
      $correlativo = Correlativo::where('documento', 'FACTURA')->first();
    }
    else
    {
      $titulo = "Generar Nota de Entrega";
      $correlativo = Correlativo::where('documento', 'NOTAENTREGA')->first();
    }
    $correlativo->correlativo = $correlativo->correlativo + 1;
    $correlativo->update();
    $facturas->numero = $correlativo->correlativo;
    $facturas->monto = $monto;
    $facturas->iva = $impuesto;
    // if ($modulo == "factura")
    // {
    //   $facturas->iva= $monto * 0.16;
    // }
    // else
    // {
    //   $facturas->iva= 0;
    // }
    $facturas->update();
    $factura = $modulo.' '.$facturas->numero;
    $bitacoras = new Bitacora;
    $bitacoras->register($bitacoras, 'C', $factura, $facturas->id, 'facturas', auth()->user()->id);
    session()->flash('message', 'Documento generado con éxito');
    return view('dralf.facturas.show')->with(['facturas' => $facturas, 'detallefacturas'=> $detallefacturas, 'modulo' => $modulo]);
  }

  /**
   * Store a newly created resource in storage.
   * 
   * @param string $modulo
   * @return \Illuminate\Http\Response
   */
  public function fprint(Factura $facturas, $modulo)
  {
    $detallefacturas = DetalleFactura::where('facturas_id', $facturas->id)->orderBy('lotes_id', 'asc')->get();
    $nombre = '';
    if ($modulo == "notaentrega") {
      $nombre = public_path().'/nota_entrega_'.$facturas->numero.'.pdf';
      // Fpdf::AddPage('P', 'Letter');
      Fpdf::AddPage('L', array(139,215));
      Fpdf::SetFont('Arial', 'B', 14);
      Fpdf::SetAutoPageBreak(true, 10);
      Fpdf::SetTopMargin(10);
      Fpdf::SetLeftMargin(10);
      Fpdf::SetRightMargin(10);
      Fpdf::Image(public_path('img/logo.png'),19,8,33);
      Fpdf::SetXY(8,20);
      Fpdf::Cell(50, 5, 'Laboratorio Dr. Alf C.A.',0,1);
      Fpdf::SetFont('Arial', 'B', 10);
      Fpdf::SetXY(140,25);
      Fpdf::Cell(50, 5, utf8_decode('NOTA DE ENTREGA Nº  ').$facturas->numero);
      Fpdf::SetXY(140,30);
      Fpdf::Cell(50, 5, 'FECHA DE EMISION  '.date('d/m/Y', strtotime($facturas->fecha)));
      Fpdf::SetXY(10,40);
      Fpdf::Cell(25, 5, 'CLIENTE: ');
      Fpdf::SetFont('Arial', '', 10);
      Fpdf::SetXY(35,40);
      Fpdf::Multicell(165, 5, $facturas->terceros->razon_social);
      Fpdf::SetFont('Arial', 'B', 10);
      Fpdf::SetXY(10,45);
      Fpdf::Cell(25, 5, 'RIF: ');
      Fpdf::SetFont('Arial', '', 10);
      Fpdf::SetXY(35,45);
      Fpdf::Cell(80, 5, $facturas->terceros->rif);
      Fpdf::SetFont('Arial', 'B', 10);
      Fpdf::SetXY(10,50);
      Fpdf::Cell(25, 5, 'DIRECCION: ');
      Fpdf::SetFont('Arial', '', 10);
      Fpdf::SetXY(35,50);
      Fpdf::Multicell(165, 5, $facturas->terceros->direccion.', '.$facturas->terceros->ciudades->nombre.', '.$facturas->terceros->ciudades->estados->nombre);
      Fpdf::Ln();
      Fpdf::Line(10,65,205,65);
      Fpdf::SetFont('Arial', '', 8);
      Fpdf::SetXY(10,66);
      Fpdf::Cell(15,4, 'LOTE');
      Fpdf::SetXY(35,66);
      Fpdf::Cell(20,4, 'PRODUCTO');
      // Fpdf::SetXY(80,66);
      // Fpdf::Cell(10,4, 'LOTE');
      Fpdf::SetXY(100,66);
      Fpdf::Cell(14,4, 'CANTIDAD');
      Fpdf::SetXY(118,66);
      Fpdf::Cell(14,4, 'UNIDAD');
      Fpdf::SetXY(150,66);
      Fpdf::Cell(15,4, 'PRECIO');
      Fpdf::SetXY(190,66);
      Fpdf::Cell(15,4, 'TOTAL');
      Fpdf::Line(10,71,205,71);
      $l = 72;
      $acumulador = 0;
      foreach($detallefacturas as $d)
      {
        Fpdf::SetXY(10,$l);
        Fpdf::Cell(15,4, $d->lotes->numero);
        Fpdf::SetXY(35,$l);
        Fpdf::Cell(20,4, $d->lotes->productos->codigo.' '.$d->lotes->productos->nombre);
        // Fpdf::SetXY(80,$l);
        // Fpdf::Cell(10,4, $d->lotes->numero);
        Fpdf::SetXY(100,$l);
        Fpdf::Cell(14,4, $d->cantidad,0,0,'C');
        Fpdf::SetXY(118,$l);
        Fpdf::Cell(14,4, $d->lotes->productos->unidadmedidas->abreviatura,0,0,'C');
        Fpdf::SetXY(140,$l);
        Fpdf::Cell(30,4, number_format($d->precio, 2, ',', '.'),0,0,'R');
        $total = $d->cantidad * $d->precio;
        $acumulador += $total;
        Fpdf::SetXY(175,$l);
        Fpdf::Cell(30,4, number_format($total, 2, ',', '.'),0,0,'R');
        $l += 4;
      }
      // Fpdf::Line(10,250,205,250);
      Fpdf::Line(10,120,205,120);
      Fpdf::SetFont('Arial', 'B', 10);
      // Fpdf::SetXY(100,251);
      Fpdf::SetXY(100,121);
      Fpdf::Cell(50,5, 'TOTAL NOTA DE ENTREGA ');
      // Fpdf::SetXY(160,251);
      Fpdf::SetXY(160,121);
      Fpdf::Cell(45,5, number_format($acumulador, 2, ',', '.'),0,0,'R');
    }
    else
    {
      //
      // FACTURA
      //
      $nombre = public_path().'/factura_'.$facturas->numero.'.pdf';
      Fpdf::AddPage('L', array(233,160));
      Fpdf::SetFont('Arial', 'B', 8);
      Fpdf::SetAutoPageBreak(true, 10);
      Fpdf::SetFont('Arial', 'B', 8);
      Fpdf::SetXY(167,34);
      Fpdf::Cell(50, 4, utf8_decode('FACTURA Nº  ').$facturas->numero);
      Fpdf::SetXY(167,38);
      Fpdf::Cell(50, 4, 'FECHA  '.date('d/m/Y', strtotime($facturas->fecha)));
      Fpdf::SetXY(55,42);
      Fpdf::Cell(25, 4, 'CLIENTE: ');
      Fpdf::SetFont('Arial', '', 8);
      Fpdf::SetXY(80,42);
      Fpdf::Multicell(165, 4, $facturas->terceros->razon_social);
      Fpdf::SetFont('Arial', 'B', 8);
      Fpdf::SetXY(55,46);
      Fpdf::Cell(25, 4, 'RIF: ');
      Fpdf::SetFont('Arial', '', 8);
      Fpdf::SetXY(80,46);
      Fpdf::Cell(80, 4, $facturas->terceros->rif);
      Fpdf::SetFont('Arial', 'B', 8);
      Fpdf::SetXY(55,50);
      Fpdf::Cell(25, 4, 'DIRECCION: ');
      Fpdf::SetFont('Arial', '', 8);
      Fpdf::SetXY(80,50);
      Fpdf::Multicell(165, 4, $facturas->terceros->direccion.', '.$facturas->terceros->ciudades->nombre.', '.$facturas->terceros->ciudades->estados->nombre);
      Fpdf::Ln();
      Fpdf::Line(55,59,215,59);
      Fpdf::SetFont('Arial', '', 8);
      Fpdf::SetXY(55,60);
      Fpdf::Cell(15,4, 'LOTE');
      Fpdf::SetXY(75,60);
      Fpdf::Cell(20,4, 'PRODUCTO');
      Fpdf::SetXY(110,60);
      Fpdf::Cell(14,4, 'CANTIDAD');
      Fpdf::SetXY(128,60);
      Fpdf::Cell(14,4, 'UNIDAD');
      Fpdf::SetXY(160,60);
      Fpdf::Cell(15,4, 'PRECIO');
      Fpdf::SetXY(200,60);
      Fpdf::Cell(15,4, 'TOTAL');
      Fpdf::Line(55,64,215,64);
      $l = 65;
      $acumulador = 0;
      foreach($detallefacturas as $d)
      {
        Fpdf::SetXY(55,$l);
        Fpdf::Cell(15,4, $d->lotes->numero);
        Fpdf::SetXY(75,$l);
        Fpdf::Cell(20,4, $d->lotes->productos->codigo.' '.$d->lotes->productos->nombre);
        Fpdf::SetXY(110,$l);
        Fpdf::Cell(14,4, $d->cantidad,0,0,'C');
        Fpdf::SetXY(128,$l);
        Fpdf::Cell(14,4, $d->lotes->productos->unidadmedidas->abreviatura,0,0,'C');
        Fpdf::SetXY(150,$l);
        Fpdf::Cell(30,4, number_format($d->precio, 2, ',', '.'),0,0,'R');
        $total = $d->cantidad * $d->precio;
        $acumulador += $total;
        Fpdf::SetXY(185,$l);
        Fpdf::Cell(30,4, number_format($total, 2, ',', '.'),0,0,'R');
        $l += 4;
      }
      Fpdf::Line(55,90,215,90);
      Fpdf::SetFont('Arial', 'B', 8);
      Fpdf::SetXY(55,120);
      Fpdf::Cell(80,5, utf8_decode('REALIZAR LOS PAGOS A NOMBRE DE ALFONSO PEÑARANDA C.I. 10.190.738'));
      Fpdf::SetXY(160,120);
      Fpdf::Cell(30,5, 'BASE IMPONIBLE ');
      Fpdf::SetXY(190,120);
      Fpdf::Cell(45,4, number_format($acumulador, 2, ',', '.'),0,0,'R');
      Fpdf::SetXY(55,124);
      Fpdf::Cell(80,5, 'BANCO PROVINCIAL CTA. NRO. 01080501550200236231');
      Fpdf::SetXY(160,124);
      Fpdf::Cell(30,4, 'IVA 16% ');
      Fpdf::SetXY(190,124);
      Fpdf::Cell(45,4, number_format($acumulador * 0.16, 2, ',', '.'),0,0,'R');
      Fpdf::SetXY(55,128);
      Fpdf::Cell(80,5, 'BANCO MERCANTIL CTA. NRO. 01050749931749061406');
      Fpdf::SetXY(160,128);
      Fpdf::Cell(30,4, 'TOTAL NETO ');
      Fpdf::SetXY(190,128);
      Fpdf::Cell(45,4, number_format($acumulador+($acumulador*0.16), 2, ',', '.'),0,0,'R');
   
    }
   
    Fpdf::Output('F', $nombre);
   
    return view('dralf.facturas.print')->with(['nombre' => $nombre]);

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
    if ($modulo == "factura")
    {
      $titulo = "Ver Factura";
    }
    else
    {
      $titulo = "Ver Nota de Entrega";
    }
    $detallefacturas = DetalleFactura::where('facturas_id', $facturas->id)->orderBy('lotes_id', 'asc')->paginate(10);
    return view('dralf.facturas.show')->with(['facturas' => $facturas, 'detallefacturas'=> $detallefacturas, 'modulo' => $modulo, 'titulo' => $titulo]);
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
