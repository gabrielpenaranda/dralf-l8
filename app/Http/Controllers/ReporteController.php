<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura;
use App\Producto;
use App\Lote;
use App\DetalleFactura;

class ReporteController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function reporteventas()
  {
    $titulo = "Reporte de Ventas";
    return view('dralf.reportes.ventas.reporteventas', ['titulo' => $titulo]);
  }

   /**
   * Display a listing of the resource.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function generareporteventas(Request $request)
  {
    $fecha_desde = date("Y-m-d", strtotime($request->get('fecha_desde')));
    $fecha_hasta = date("Y-m-d", strtotime($request->get('fecha_hasta')));
    if ($fecha_desde == $fecha_hasta) {
        $facturas = Factura::where('fecha', $fecha_desde)->orderBy('numero', 'asc')->get();
    }
    else if ($fecha_desde > $fecha_hasta)
    {
        session()->flash('warning', 'Fecha de final no puede ser mayor a fecha inicio');
        return redirect()->route('admin.index');
    }
    else
    {
        $facturas = Factura::where('fecha', '>=', $fecha_desde)->where('fecha', '<=', $fecha_hasta)->orderBy('fecha', 'asc')->orderBy('numero', 'asc')->get();
    }
    $titulo = "Reporte de Ventas";
    return view('dralf.reportes.ventas._reporteventas', ['titulo' => $titulo, 'facturas' => $facturas, 'desde' => $request->get('fecha_desde'), 'hasta' => $request->get('fecha_hasta')]);
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function reporteventasxproducto()
 {
   $productos = Producto::all();
   $titulo = "Reporte de Ventas";
   return view('dralf.reportes.ventas.reporteventasxproducto', ['titulo' => $titulo, 'productos' => $productos]);
 }

  /**
  * Display a listing of the resource.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
 public function generareporteventasxproducto(Request $request)
 {
   $fecha_desde = date("Y-m-d", strtotime($request->get('fecha_desde')));
   $fecha_hasta = date("Y-m-d", strtotime($request->get('fecha_hasta')));
   $productos = Producto::where('id', $request->get('producto'))->first();
   if ($fecha_desde == $fecha_hasta) {
      $acumulador = 0;
      $facturas = Factura::where('fecha', $fecha_desde)->orderBy('numero', 'asc')->get();
      foreach($facturas as $f){
        $detallefacturas = DetalleFactura::where('facturas_id', $f->id)->get();
        foreach($detallefacturas as $df) {
          if ($df->lotes->productos->id == $productos->id) {
            $acumulador += $df->cantidad; 
          }
        }
       }
      dd($acumulador);
   }
   else if ($fecha_desde > $fecha_hasta)
   {
       session()->flash('warning', 'Fecha de final no puede ser mayor a fecha inicio');
       return redirect()->route('admin.index');
   }
   else
   {
      $facturas = Factura::where('fecha', '>=', $fecha_desde)->where('fecha', '<=', $fecha_hasta)->orderBy('fecha', 'asc')->orderBy('numero', 'asc')->get();
      $acumulador = 0;
      foreach($facturas as $f){
        $detallefacturas = DetalleFactura::where('facturas_id', $f->id)->get();
        foreach($detallefacturas as $df) {
          if ($df->lotes->productos->id == $productos->id) {
            $acumulador += $df->cantidad; 
          }
        }
       }
      dd($acumulador);
   }
   $titulo = "Reporte de Ventas";
   return view('dralf.reportes.ventas._reporteventasxproducto', ['titulo' => $titulo, 'facturas' => $facturas, 'desde' => $request->get('fecha_desde'), 'hasta' => $request->get('fecha_hasta')]);
 }

 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function reporteventasxproductog()
 {
   $titulo = "Reporte de Ventas";
   return view('dralf.reportes.ventas.reporteventasxproductog', ['titulo' => $titulo]);
 }

  /**
  * Display a listing of the resource.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
 public function generareporteventasxproductog(Request $request)
 {
   $fecha_desde = date("Y-m-d", strtotime($request->get('fecha_desde')));
   $fecha_hasta = date("Y-m-d", strtotime($request->get('fecha_hasta')));
   $productos = Producto::all();
   $aproducto = array();
   foreach($productos as $p) {
     $aproducto[$p->id] = 0;
   }
   if ($fecha_desde == $fecha_hasta) {
      $facturas = Factura::where('fecha', $fecha_desde)->orderBy('numero', 'asc')->get();
      // foreach($facturas as $f){
      //   $detallefacturas = DetalleFactura::where('facturas_id', $f->id)->get();
      //   foreach($detallefacturas as $df) {
      //     foreach($aproducto as $i => &$ap) {
      //       if ($df->lotes->productos->id == $i) {
      //         $ap += $df->cantidad; 
      //       }
      //     }
      //   }

      foreach($facturas as $f){
        $detallefacturas = DetalleFactura::where('facturas_id', $f->id)->get();
        foreach($detallefacturas as $df) {
          foreach($productos as $p) {
            if ($df->lotes->productos->id == $p->id) {
              $aproducto[$p->id] += $df->cantidad; 
            }
          }
        }
       }
      dd($aproducto);
   }
   else if ($fecha_desde > $fecha_hasta)
   {
       session()->flash('warning', 'Fecha de final no puede ser mayor a fecha inicio');
       return redirect()->route('admin.index');
   }
   else
   {
      $facturas = Factura::where('fecha', '>=', $fecha_desde)->where('fecha', '<=', $fecha_hasta)->get();
      // dd($facturas);
      foreach($facturas as $f) {
        echo $f->id;
        $detallefacturas = DetalleFactura::where('facturas_id', $f->id)->get();
        foreach($detallefacturas as $df) {
          // $productos = Producto::all();
          foreach($productos as $p) {
            if ($df->lotes->productos->id == $p->id) {
              $aproducto[$p->id] += $df->cantidad;
              echo 'factura '.$f->numero.' cantidad '.$df->cantidad.' acum '.$aproducto[$p->id];
              // sleep(10);
            }
          }
       }
      dd($aproducto);
   }
   $titulo = "Reporte de Ventas";
   return view('dralf.reportes.ventas._reporteventasxproducto', ['titulo' => $titulo, 'facturas' => $facturas, 'desde' => $request->get('fecha_desde'), 'hasta' => $request->get('fecha_hasta')]);
 }
}

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function reporteiva()
  {
    $titulo = "Reporte de IVA";
    return view('dralf.reportes.ventas.reporteiva', ['titulo' => $titulo]);
  }

   /**
   * Display a listing of the resource.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function generareporteiva(Request $request)
  {
    $fecha_desde = date("Y-m-d", strtotime($request->get('fecha_desde')));
    $fecha_hasta = date("Y-m-d", strtotime($request->get('fecha_hasta')));
    if ($fecha_desde == $fecha_hasta) {
        $facturas = Factura::where('fecha', $fecha_desde)->orderBy('numero', 'asc')->get();
    }
    else if ($fecha_desde > $fecha_hasta)
    {
        session()->flash('warning', 'Fecha de final no puede ser mayor a fecha inicio');
        return redirect()->route('admin.index');
    }
    else
    {
        $facturas = Factura::where('fecha', '>=', $fecha_desde)->where('fecha', '<=', $fecha_hasta)->orderBy('fecha', 'asc')->orderBy('numero', 'asc')->get();
    }
    $titulo = "Reporte de IVA";
    return view('dralf.reportes.ventas._reporteiva', ['titulo' => $titulo, 'facturas' => $facturas, 'desde' => $request->get('fecha_desde'), 'hasta' => $request->get('fecha_hasta')]);
  }
}
