<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura;

class ReporteFacturaController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dralf.report.factura.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function report_iva_index()
    {
        return view('dralf.report.factura.iva_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function report_iva_show(Request $request)
    {
        $inicio = date('Y-m-d', strtotime($request->get('inicio')));
        $final = date('Y-m-d', strtotime($request->get('final')));
        $iva = Factura::where('fecha_factura', '>=', $inicio)->where('fecha_factura', '<=', $final)->get();
        return view('dralf.report.factura.iva_show')->with('iva', $iva)->with('inicio', $inicio)->with('final', $final);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function report_factura_index()
    {
        return view('dralf.report.factura.factura_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function report_factura_show(Request $request)
    {
        $inicio = date('Y-m-d', strtotime($request->get('inicio')));
        $final = date('Y-m-d', strtotime($request->get('final')));
        $factura = Factura::where('fecha_factura', '>=', $inicio)->where('fecha_factura', '<=', $final)->get();
        return view('dralf.report.factura.factura_show')->with('factura', $factura)->with('inicio', $inicio)->with('final', $final);
    }
}
