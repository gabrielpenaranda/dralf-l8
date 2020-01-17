<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura;

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
