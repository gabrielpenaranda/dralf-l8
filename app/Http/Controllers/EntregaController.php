<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Correlativo;
use App\Models\DetalleEntrega;
use App\Models\DetalleFactura;
use App\Models\Entrega;
use App\Models\Factura;
use Illuminate\Http\Request;

class EntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facturas = Factura::orderBy('numero', 'desc')->paginate(10);
        $modulo = '';

        return view('dralf.entregas.index', compact('facturas', 'modulo'));
    }

    /**
     * Display a listing of the resource._
     *
     * @param string $modulo
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $facturas, $modulo)
    {
        if ($modulo == 'factura') {
            $titulo = 'Ver Entrega (Factura)';
        } else {
            $titulo = 'Ver Entrega (Nota de Entrega)';
        }
        $detallefacturas = DetalleFactura::where('facturas_id', $facturas->id)->orderBy('lotes_id', 'asc')->get();
        $entregas = Entrega::where('facturas_id', $facturas->id)->orderBy('numero', 'desc')->get();
        foreach($entregas as $e) {
            $detalleentregas[] = DetalleEntrega::where('entregas_id', $e->id)->get();
        }
        return view('dralf.entregas.show', compact('facturas', 'detallefacturas', 'entregas', 'detalleentregas', 'modulo', 'titulo'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $modulo
     *
     * @return \Illuminate\Http\Response
     */
    public function total(Factura $facturas, $modulo)
    {
        if ($modulo == 'factura') {
            $titulo = 'Entrega Total (Factura)';
        } else {
            $titulo = 'Entrega Total (Nota de Entrega)';
        }
        $detallefacturas = DetalleFactura::where('facturas_id', $facturas->id)->orderBy('lotes_id', 'asc')->paginate(10);

        return view('dralf.entregas.total', compact('facturas', 'detallefacturas', 'modulo', 'titulo'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $modulo
     *
     * @return \Illuminate\Http\Response
     */
    public function etotal(Factura $facturas, $modulo)
    {
        $correlativo = Correlativo::where('documento', 'ENTREGA')->first();
        $entregas = new Entrega();
        $entregas->fecha = date('Y-m-d');
        $correlativo->correlativo = $correlativo->correlativo + 1;
        $correlativo->update();
        $entregas->numero = $correlativo->correlativo;
        $entregas->facturas_id = $facturas->id;
        $entregas->save();
        $bitacoras = new Bitacora();
        $bitacoras->register($bitacoras, 'C', $entregas->numero, $entregas->id, 'entregas', auth()->user()->id);
        $detallefacturas = DetalleFactura::where('facturas_id', $facturas->id)->orderBy('lotes_id', 'asc')->get();
        foreach ($detallefacturas as $df) {
            $de = new DetalleEntrega();
            $df->resto = 0;
            $de->cantidad = $df->cantidad;
            $de->entregas_id = $entregas->id;
            $de->detallefacturas_id = $df->id;
            $df->update();
            $de->save();
        }
        $factura = Factura::where('id', $facturas->id)->where('documento', $modulo)->first();
        $factura->entregado = 'E';
        $factura->update();

        return redirect()->route('entregas.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $modulo
     *
     * @return \Illuminate\Http\Response
     */
    public function parcial(Factura $facturas, $modulo)
    {
        if ($modulo == 'factura') {
            $titulo = 'Entrega Total (Factura)';
        } else {
            $titulo = 'Entrega Total (Nota de Entrega)';
        }
        $detallefacturas = DetalleFactura::where('facturas_id', $facturas->id)->orderBy('lotes_id', 'asc')->paginate(10);

        return view('dralf.entregas.parcial', compact('facturas', 'detallefacturas', 'modulo', 'titulo'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function eparcial(Request $request)
    {
        $facturas_id = $request->get('facturas');
        $modulo = $request->get('modulo');
        $detallefacturas_id = $request->get('detallefacturas_id');
        $cantidad = $request->get('cantidad');
        $correlativo = Correlativo::where('documento', 'ENTREGA')->first();
        $entregas = new Entrega();
        $entregas->fecha = date('Y-m-d');
        $correlativo->correlativo = $correlativo->correlativo + 1;
        $correlativo->update();
        $entregas->numero = $correlativo->correlativo;
        $entregas->facturas_id = $facturas_id;
        $entregas->save();
        $bitacoras = new Bitacora();
        $bitacoras->register($bitacoras, 'C', $entregas->numero, $entregas->id, 'entregas', auth()->user()->id);
        $i = 0;
        foreach ($detallefacturas_id as $dfi) {
            if ($cantidad[$i] > 0) {
                $df = DetalleFactura::where('id', $dfi)->first();
                $de = new DetalleEntrega();
                $df->resto = $df->resto - $cantidad[$i];
                $de->cantidad = $cantidad[$i];
                $de->entregas_id = $entregas->id;
                $de->detallefacturas_id = $df->id;
                $df->update();
                $de->save();
            }
            ++$i;
        }
        $detalle = DetalleFactura::where('id', $facturas_id)->get();
        $acum = 0;
        foreach ($detalle as $d){
            $acum = $acum + $d->resto;
        }
        $factura = Factura::where('id', $facturas_id)->where('documento', $modulo)->first();
        if ($acum > 0) {
            $factura->entregado = 'P';
        } else {
            $factura->entregado = 'E';
        }
        $factura->update();

        return redirect()->route('entregas.index');
    }

}
