<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateLoteRequest;
use App\Http\Requests\UpdateLoteRequest;
use App\Models\Lote;
use App\Models\Producto;
use App\Models\Deposito;
use App\Models\Bitacora;
use App\Models\PruebaAnticoagulante;
use App\Models\PruebaDiluente;
use App\Models\PruebaLisante;
use App\Models\PruebaRinse;
use Fpdf;

class LoteController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $lotes = Lote::orderBy('numero', 'desc')->paginate(7);
    return view('dralf.lotes.index')->with(['lotes' => $lotes]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $lotes = new Lote;
    $productos = Producto::all();
    $depositos = Deposito::all();
    $titulo = 'Crear Lote';
    if (count($productos) == 0)
    {
      session()->flash('error', 'Debe incluir un producto antes de incluir un lote');
      return redirect()->route('lotes.index');
    }
    return view('dralf.lotes.form')->with(['lotes' => $lotes])->with(['productos' => $productos])->with(['depositos' => $depositos])->with(['titulo' => $titulo]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreateLoteRequest $request)
  {
    $fecha_produccion = date("Y-m-d", strtotime($request->get('fecha_produccion')));
    $fecha_vencimiento = date("Y-m-d", strtotime($request->get('fecha_vencimiento')));
    $lotes = new Lote;
    $lotes->numero = strtoupper($request->get('numero'));
    $lotes->fecha_produccion = $fecha_produccion;
    $lotes->fecha_vencimiento = $fecha_vencimiento;
    $lotes->cantidad_producida = $request->get('cantidad_producida');
    $lotes->cantidad_prueba = $request->get('cantidad_prueba');
    $lotes->cantidad_disponible = $request->get('cantidad_producida') - $request->get('cantidad_prueba');
    $prueba = Producto::find($request->get('productos_id'))->get('prueba');
    $prueba = DB::table('productos')->where('id', $request->get('productos_id'))->first();
    $lotes->prueba = $prueba->prueba;
    $lotes->costo = 0;
    $lotes->productos_id = $request->get('productos_id');
    $lotes->depositos_id = $request->get('depositos_id');
    $lotes->numero_certificado = '';
    $lotes->save();
    $bitacoras = new Bitacora;
    $bitacoras->register($bitacoras, 'C', $lotes->numero, $lotes->id, 'lotes', auth()->user()->id);
    session()->flash('message', 'Lote creado con éxito!');
    return redirect()->route('lotes.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $lotes
   * @return \Illuminate\Http\Response
   */
  public function show($lotes)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $lotes
   * @return \Illuminate\Http\Response
   */
  public function edit(Lote $lotes)
  {
    try
    {
        if ($lotes->detallefacturas->count() > 0)
        {
          session()->flash('warning', 'No puede modificar el lote, posee información relacionada');
          return redirect()->route('lotes.index');
        }
        else
        {
          $productos = Producto::all();
          $depositos = Deposito::all();
          $titulo = 'Editar Lote';
          return view('dralf.lotes.form')->with(['lotes' => $lotes])->with(['productos' => $productos])->with(['depositos' => $depositos])->with(['titulo' => $titulo]);
        }
    }
    catch (\Illuminate\Database\QueryException $e) {
        if($e->getCode() == "42S22") {
            $productos = Producto::all();
            $depositos = Deposito::all();
            $titulo = 'Editar Lote';
            return view('dralf.lotes.form')->with(['lotes' => $lotes])->with(['productos' => $productos])->with(['depositos' => $depositos])->with(['titulo' => $titulo]);
        }
    }

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $lotes
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateLoteRequest $request, Lote $lotes)
  {
    $fecha_produccion = date("Y-m-d", strtotime($request->get('fecha_produccion')));
    $fecha_vencimiento = date("Y-m-d", strtotime($request->get('fecha_vencimiento')));
    $lotes->fecha_produccion = $fecha_produccion;
    $lotes->fecha_vencimiento = $fecha_vencimiento;
    $lotes->cantidad_producida = $request->get('cantidad_producida');
    $lotes->cantidad_prueba = $request->get('cantidad_prueba');
    $lotes->cantidad_disponible = $request->get('cantidad_producida') - $request->get('cantidad_prueba');
    $prueba = DB::table('productos')->where('id', $request->get('productos_id'))->first();
    $lotes->prueba = $prueba->prueba;
    $lotes->productos_id = $request->get('productos_id');
    $lotes->depositos_id = $request->get('depositos_id');
    $bitacoras = new Bitacora;
    $bitacoras->register($bitacoras, 'U', $lotes->numero, $lotes->id, 'lotes', auth()->user()->id);
    $lotes->update();
    session()->flash('message', 'Lote actualizado!');
    return redirect()->route('lotes.index');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $lotes
   * @return \Illuminate\Http\Response
   */
  public function certify(Lote $lotes)
  {
    $fecha = date('Ymd');
    if ($lotes->prueba != 'NO') {
      switch ($lotes->productos->prueba)
      {
        case 'ANTICOAGULANTE':
          $pruebas = PruebaAnticoagulante::where('lotes_id', $lotes->id)->get();
          break;
        case 'DILUENTE':
          $pruebas = PruebaDiluente::where('lotes_id', $lotes->id)->get();
          break;
        case 'LISANTE':
          $pruebas = PruebaLisante::where('lotes_id', $lotes->id)->get();
          break;
        case 'RINSE':
          $pruebas = PruebaRinse::where('lotes_id', $lotes->id)->get();
          break;
      }
      if (count($pruebas) > 0) {
        $lotes->certificado = true;
        $lotes->numero_certificado = $fecha.'-'.$lotes->numero.'-'.$lotes->id;
        $bitacoras = new Bitacora;
        $bitacoras->register($bitacoras, 'U', $lotes->numero, $lotes->id, 'lotes certificado', auth()->user()->id);
        $lotes->update();
        session()->flash('message', 'Lote certificado!');
      }
      else{
        session()->flash('warning', 'Lote no puede ser certificado, no posee pruebas!');
      }
    }
    else
    {
      $lotes->certificado = true;
      $lotes->numero_certificado = $fecha.'-'.$lotes->numero.'-'.$lotes->id;
      $bitacoras = new Bitacora;
      $bitacoras->register($bitacoras, 'U', $lotes->numero, $lotes->id, 'lotes certificado', auth()->user()->id);
      $lotes->update();
      session()->flash('message', 'Lote certificado!');
    }
    return redirect()->route('lotes.index');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $lotes
   * @return \Illuminate\Http\Response
   */
  public function print(Lote $lotes)
  {
    $texto ="Laboratorio Dr. Alf certifica que este producto ha cumplido satisfactoriamente con todas las pruebas de calidad realizadas, arrojando valores dentro de los parámetros aceptables para su utilización.";
    $nombre = public_path().'/certificado_'.$lotes->productos->nombre.'_'.$lotes->numero_certificado.'.pdf';
      Fpdf::AddPage('P', 'Letter');
      Fpdf::SetFont('Arial', 'B', 14);
      Fpdf::SetAutoPageBreak(true, 10);
      Fpdf::SetTopMargin(10);
      Fpdf::SetLeftMargin(10);
      Fpdf::SetRightMargin(10);
      Fpdf::Image(public_path('img/logo.png'),19,8,33);
      Fpdf::SetXY(8,20);
      Fpdf::Cell(50, 5, 'Laboratorio Dr. Alf C.A.',0,1);
      Fpdf::SetFont('Arial', 'B', 20);
      Fpdf::SetXY(1,60);
      Fpdf::Cell(0, 5, utf8_decode('CERTIFICADO Nº '.$lotes->numero_certificado),0,0,'C');
      Fpdf::SetXY(40,40);
      Fpdf::SetFont('Arial', 'B', 14);
      Fpdf::SetXY(20,75);
      Fpdf::Cell(25, 5, utf8_decode('LOTE Nº: ').$lotes->numero);
      Fpdf::SetXY(20,85);
      Fpdf::Cell(25, 5, 'PRODUCTO: '.$lotes->productos->nombre);
      Fpdf::SetXY(20,95);
      Fpdf::Cell(25, 5, utf8_decode('FECHA DE PRODUCCIÓN: '.date('d/m/Y', strtotime($lotes->fecha_produccion))));
      Fpdf::SetXY(20,105);
      Fpdf::Cell(25, 5, utf8_decode('FECHA DE VENCIMIENTO: '.date('d/m/Y', strtotime($lotes->fecha_vencimiento))));
      Fpdf::SetFont('Arial', '', 14);
      Fpdf::SetXY(20,120);
      Fpdf::Multicell(175, 5, utf8_decode($texto));

      Fpdf::Output('F', $nombre);

      return view('dralf.lotes.print')->with(['nombre' => $nombre]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $lotes
   * @return \Illuminate\Http\Response
   */
  public function destroy(Lote $lotes)
  {
      try {
          $lotes->delete();
          $bitacoras = new Bitacora;
          $bitacoras->register($bitacoras, 'D', $lotes->numero, $lotes->id, 'lotes certificado', auth()->user()->id);
          session()->flash('message', 'Lote eliminado!');
          return redirect()->route('lotes.index');
      }
      catch (\Illuminate\Database\QueryException $e) {
          if($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
              session()->flash('warning', 'No puede eliminar producto, posee información relacionada');
              return redirect()->route('lotes.index');
          }
      }
  }
}
