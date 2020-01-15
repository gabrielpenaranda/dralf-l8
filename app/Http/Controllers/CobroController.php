<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Requests\CreateCobroController;

use App\Factura;
use App\Cobro;

class CobroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $modulo
     * @return \Illuminate\Http\Response
     */
    public function index($modulo)
    {
        $factura = Factura::where('saldo_factura', '>', 0)->paginate(10);
        return view('dralf.cobro.index')->with(['factura' => $factura])->with(['modulo' => $modulo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param string $modulo
     * @param int $factura
     * @return \Illuminate\Http\Response
     */
    public function create(Factura $factura, $modulo)
    {
        $cobro = new Cobro;
        return view('dralf.cobro.create')->with(['factura' => $factura])->with(['cobro' => $cobro])->with(['modulo' => $modulo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param string $modulo
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $modulo)
    {
        $factura = Factura::where('id', $request->get('factura_id'))->first();
        $cobro = new Cobro;
        $fecha = date('Y-m-d', strtotime($request->get('fecha_cobro')));
        $cobro->numero_cobro = $request->get('numero_cobro');
        $cobro->fecha_cobro = $fecha;
        $cobro->monto_cobro = $request->get('monto_cobro');
        $cobro->banco_cobro = $request->get('banco_cobro');
        $cobro->factura_id = $request->get('factura_id');
        $cobro->user_id = auth()->user()->id;
        $factura->saldo_factura -= $request->get('monto_cobro');
        $factura->update();
        $cobro->save();
        session()->flash('message', 'cobro registrado satisfactoriamente!');
        return redirect()->route('cobros.index', ['modulo' => $modulo]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $modulo
     * @param  int  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura, $modulo)
    {
        $cobros = Cobro::where('factura_id', $factura->id)->orderBy('fecha_cobro', 'desc')->get();
        return view('dralf.cobro.show')->with(['cobros' => $cobros])->with(['factura' => $factura])->with(['modulo' => $modulo]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param string $modulo
     * @return \Illuminate\Http\Response
     */
    public function facturas_canceladas($modulo)
    {
        $factura = Factura::where('saldo_factura', '<=', 0)->paginate(10);
        return view('dralf.cobro.facturas_canceladas')->with(['factura' => $factura])->with(['modulo' => $modulo]);
    }

}
