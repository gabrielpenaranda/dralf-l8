<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateEntregaRequest;
use App\Http\Requests\UpdateEntregaRequest;
use App\Factura;
use App\DetalleFactura;
use App\Entrega;
use App\DetalleEntrega;
use App\Tercero;
use App\Producto;
use App\Lote;
use App\Correlativo;
use App\Bitacora;
use Fpdf;


class EntregaController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @param string $modulo
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $entregas = Entrega::orderBy('numero', 'desc')->paginate(10);
    return view('dralf.entregas.index')->with(['entregas' => $entregas]);
  }
}
