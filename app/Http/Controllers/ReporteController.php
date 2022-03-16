<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\Producto;
use App\Models\Tercero;
use App\Models\Lote;
use App\Models\DetalleFactura;

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
   $acumulador = 0;
   $acumuladormonto = 0;
   if ($fecha_desde == $fecha_hasta) {
      $facturas = Factura::where('fecha', $fecha_desde)->orderBy('numero', 'asc')->get();
      foreach($facturas as $f){
        $detallefacturas = DetalleFactura::where('facturas_id', $f->id)->get();
        foreach($detallefacturas as $df) {
          if ($df->lotes->productos->id == $productos->id) {
            $acumulador += $df->cantidad; 
            $acumuladormonto += $df->precio * $df->cantidad;
          }
        }
       }
      // dd($acumulador);
   }
   else if ($fecha_desde > $fecha_hasta)
   {
       session()->flash('warning', 'Fecha de final no puede ser mayor a fecha inicio');
       return redirect()->route('admin.index');
   }
   else
   {
      $facturas = Factura::where('fecha', '>=', $fecha_desde)->where('fecha', '<=', $fecha_hasta)->orderBy('fecha', 'asc')->orderBy('numero', 'asc')->get();
      foreach($facturas as $f){
        $detallefacturas = DetalleFactura::where('facturas_id', $f->id)->get();
        foreach($detallefacturas as $df) {
          if ($df->lotes->productos->id == $productos->id) {
            $acumulador += $df->cantidad;
            $acumuladormonto += $df->precio * $df->cantidad;
          }
        }
       }
      // dd($acumulador);
   }
   $titulo = "Reporte de Ventas x Producto";
   return view('dralf.reportes.ventas._reporteventasxproducto', ['titulo' => $titulo, 'productos' => $productos, 'acumulador' => $acumulador, 'acumuladormonto' => $acumuladormonto, 'desde' => $request->get('fecha_desde'), 'hasta' => $request->get('fecha_hasta')]);
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
     $amonto[$p->id] = 0;
   }
   if ($fecha_desde == $fecha_hasta) {
      $facturas = Factura::where('fecha', $fecha_desde)->orderBy('fecha', 'asc')->get();
      foreach($facturas as $f) {
        $detallefacturas = DetalleFactura::where('facturas_id', $f->id)->get();
        // echo 'Factura id '.$f->id.' Numero '.$f->numero.' Fecha '.$f->fecha.'<br>';
        foreach($detallefacturas as $df) {
          $aproducto[$df->lotes->productos->id] += $df->cantidad;
          $amonto[$df->lotes->productos->id] += ($df->cantidad * $df->precio);
          // echo '        '.'Factura id '.$df->facturas_id.' '.$df->lotes->productos->nombre.' '.$df->cantidad.'<br>';       
        }
        // echo '<br>';
      }
      // dd($aproducto);
   }
   else if ($fecha_desde > $fecha_hasta)
   {
       session()->flash('warning', 'Fecha de final no puede ser mayor a fecha inicio');
       return redirect()->route('admin.index');
   }
   else
   {
      $facturas = Factura::where('fecha', '>=', $fecha_desde)->where('fecha', '<=', $fecha_hasta)->orderBy('fecha', 'asc')->get();
      foreach($facturas as $f) {
        $detallefacturas = DetalleFactura::where('facturas_id', $f->id)->get();
        // echo 'Factura id '.$f->id.' Numero '.$f->numero.' Fecha '.$f->fecha.'<br>';
        foreach($detallefacturas as $df) {
          $aproducto[$df->lotes->productos->id] += $df->cantidad;
          $amonto[$df->lotes->productos->id] += ($df->cantidad * $df->precio);
          // echo '        '.'Factura id '.$df->facturas_id.' '.$df->lotes->productos->nombre.' '.$df->cantidad.'<br>';       
        }
        // echo '<br>';
      }
      // dd($aproducto);
   }
   $titulo = "Reporte de Ventas x Producto";
   return view('dralf.reportes.ventas._reporteventasxproductog', ['titulo' => $titulo, 'productos'  => $productos, 'aproducto' => $aproducto, 'amonto' => $amonto, 'desde' => $request->get('fecha_desde'), 'hasta' => $request->get('fecha_hasta')]);
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



  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function reporteventasxtercero()
 {
   $terceros = Tercero::all();
   $titulo = "Reporte de Ventas x Tercero";
   return view('dralf.reportes.ventas.reporteventasxtercero', ['titulo' => $titulo, 'terceros' => $terceros]);
 }

  /**
  * Display a listing of the resource.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
 public function generareporteventasxtercero(Request $request)
 {
   $fecha_desde = date("Y-m-d", strtotime($request->get('fecha_desde')));
   $fecha_hasta = date("Y-m-d", strtotime($request->get('fecha_hasta')));
   $terceros = Tercero::where('id', $request->get('tercero'))->first();
  //  $acumulador = 0;
  //  $acumuladormonto = 0;
   if ($fecha_desde == $fecha_hasta) {
      $facturas = Factura::where('terceros_id', $request->get('tercero'))->where('fecha', $fecha_desde)->orderBy('numero', 'asc')->get();
      // foreach($facturas as $f){
      //   $detallefacturas = DetalleFactura::where('facturas_id', $f->id)->get();
      //   foreach($detallefacturas as $df) {
      //     if ($df->lotes->productos->id == $productos->id) {
      //       $acumulador += $df->cantidad; 
      //       $acumuladormonto += $df->precio * $df->cantidad;
      //     }
      //   }
      //  }
      // dd($acumulador);
   }
   else if ($fecha_desde > $fecha_hasta)
   {
       session()->flash('warning', 'Fecha de final no puede ser mayor a fecha inicio');
       return redirect()->route('admin.index');
   }
   else
   {
      $facturas = Factura::where('terceros_id', $request->get('tercero'))->where('fecha', '>=', $fecha_desde)->where('fecha', '<=', $fecha_hasta)->orderBy('fecha', 'asc')->orderBy('numero', 'asc')->get();
      // foreach($facturas as $f){
      //   $detallefacturas = DetalleFactura::where('facturas_id', $f->id)->get();
      //   foreach($detallefacturas as $df) {
      //     if ($df->lotes->productos->id == $productos->id) {
      //       $acumulador += $df->cantidad;
      //       $acumuladormonto += $df->precio * $df->cantidad;
      //     }
      //   }
      //  }
      // dd($acumulador);
   }
  //  dd($terceros);
   $titulo = "Reporte de Ventas x Producto";
   return view('dralf.reportes.ventas._reporteventasxtercero', ['titulo' => $titulo, 'terceros' => $terceros, 'facturas' => $facturas, 'desde' => $request->get('fecha_desde'), 'hasta' => $request->get('fecha_hasta')]);
 }

 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function reporteventasxtercerog()
 {
   $terceros = Tercero::all();
   $titulo = "Reporte de Ventas x Tercero";
   return view('dralf.reportes.ventas.reporteventasxtercerog', ['titulo' => $titulo, 'terceros' => $terceros]);
 }


/**
  * Display a listing of the resource.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
 public function generareporteventasxtercerog(Request $request)
 {
   $fecha_desde = date("Y-m-d", strtotime($request->get('fecha_desde')));
   $fecha_hasta = date("Y-m-d", strtotime($request->get('fecha_hasta')));
   $terceros = Tercero::orderBy('nombre', 'asc')->get();
   $factura = array();
   if ($fecha_desde == $fecha_hasta) {
     foreach($terceros as $t) {
       $facturas = Factura::where('terceros_id', $t->id)->where('fecha', $fecha_desde)->orderBy('numero', 'asc')->get();
       $factura[$t->id] = $facturas;
     }
   }
   else if ($fecha_desde > $fecha_hasta)
   {
       session()->flash('warning', 'Fecha de final no puede ser mayor a fecha inicio');
       return redirect()->route('admin.index');
   }
   else
   {
     foreach($terceros as $t) {
       $facturas = Factura::where('terceros_id', $t->id)->where('fecha', '>=', $fecha_desde)->where('fecha', '<=', $fecha_hasta)->orderBy('fecha', 'asc')->orderBy('numero', 'asc')->get();
       $factura[$t->id] = $facturas;
     }
   $titulo = "Reporte de Ventas x Tercero";
   return view('dralf.reportes.ventas._reporteventasxtercerog', ['titulo' => $titulo, 'terceros' => $terceros, 'factura' => $factura, 'desde' => $request->get('fecha_desde'), 'hasta' => $request->get('fecha_hasta')]);
 }
}


/**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function reporteventasxtp()
 {
   $terceros = Tercero::all();
   $titulo = "Ventas de Producto x Tercero";
   return view('dralf.reportes.ventas.reporteventasxtp', ['titulo' => $titulo, 'terceros' => $terceros]);
 }

  /**
  * Display a listing of the resource.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
 public function generareporteventasxtp(Request $request)
 {
   $fecha_desde = date("Y-m-d", strtotime($request->get('fecha_desde')));
   $fecha_hasta = date("Y-m-d", strtotime($request->get('fecha_hasta')));
   $terceros = Tercero::where('id', $request->get('tercero'))->first();
   $productos = Producto::all();
   $aproducto = array();
   foreach($productos as $p) {
     $aproducto[$p->id] = 0;
     $amonto[$p->id] = 0;
   }
   if ($fecha_desde == $fecha_hasta) {
      $facturas = Factura::where('terceros_id', $request->get('tercero'))->where('fecha', $fecha_desde)->orderBy('numero', 'asc')->get();
      foreach($facturas as $f){
        $detallefacturas = DetalleFactura::where('facturas_id', $f->id)->get();
        foreach($detallefacturas as $df) {
          $aproducto[$df->lotes->productos->id] += $df->cantidad;
          $amonto[$df->lotes->productos->id] += ($df->cantidad * $df->precio);
          }
        }
   }
   else if ($fecha_desde > $fecha_hasta)
   {
       session()->flash('warning', 'Fecha de final no puede ser mayor a fecha inicio');
       return redirect()->route('admin.index');
   }
   else
   {
      $facturas = Factura::where('terceros_id', $request->get('tercero'))->where('fecha', '>=', $fecha_desde)->where('fecha', '<=', $fecha_hasta)->orderBy('fecha', 'asc')->orderBy('numero', 'asc')->get();
      foreach($facturas as $f){
        $detallefacturas = DetalleFactura::where('facturas_id', $f->id)->get();
        foreach($detallefacturas as $df) {
          $aproducto[$df->lotes->productos->id] += $df->cantidad;
          $amonto[$df->lotes->productos->id] += ($df->cantidad * $df->precio);
          }
        }
   }
   $titulo = "Ventas de Producto x Tercero";
   return view('dralf.reportes.ventas._reporteventasxtp', ['titulo' => $titulo, 'terceros' => $terceros, 'productos' => $productos, 'aproducto' => $aproducto, 'amonto' => $amonto, 'desde' => $request->get('fecha_desde'), 'hasta' => $request->get('fecha_hasta')]);
 }

}