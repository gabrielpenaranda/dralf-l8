<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateMateriaPrimaRequest;
use App\Http\Requests\UpdateMateriaPrimaRequest;
use App\Models\MateriaPrima;
use App\Models\UnidadMedida;
use App\Models\Bitacora;

class MateriaPrimaController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materiaprimas = MateriaPrima::orderBy('nombre', 'asc')->paginate(10);
        return view('dralf.materiaprimas.index')->with(['materiaprimas' => $materiaprimas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materiaprimas = new MateriaPrima;
        $unidadmedidas = UnidadMedida::orderBy('unidad', 'asc')->get();
        $titulo = 'Crear MateriaPrima';
        return view('dralf.materiaprimas.form')->with(['materiaprimas' => $materiaprimas, 'unidadmedidas' => $unidadmedidas, 'titulo' => $titulo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMateriaPrimaRequest $request)
    {
        $materiaprimas = new MateriaPrima;
        $materiaprimas->codigo = strtoupper($request->get('codigo'));
        $materiaprimas->nombre = strtoupper($request->get('nombre'));
        $materiaprimas->unidadmedidas_id = $request->get('unidadmedidas_id');
        $materiaprimas->cantidad_disponible = 0;
        $materiaprimas->fraccionable = (boolean)$request->get('fraccionable');
        $materiaprimas->save();
        $bitacoras = new Bitacora;
        $bitacoras->register($bitacoras, 'C', $materiaprimas->nombre, $materiaprimas->id, 'materiaprimas', auth()->user()->id);
        session()->flash('message', 'Materia Prima creado con éxito!');
        return redirect()->route('materiaprimas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $materiaprimas
     * @return \Illuminate\Http\Response
     */
    public function show($materiaprimas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $materiaprimas
     * @return \Illuminate\Http\Response
     */
    public function edit(MateriaPrima $materiaprimas)
    {
        $unidadmedidas = UnidadMedida::orderBy('unidad', 'asc')->get();
        $titulo = 'Editar MateriaPrima';
        return view('dralf.materiaprimas.form')->with(['materiaprimas' => $materiaprimas, 'unidadmedidas' => $unidadmedidas, 'titulo' => $titulo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $materiaprimas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMateriaPrimaRequest $request, MateriaPrima $materiaprimas)
    {
        $materiaprimas->codigo = strtoupper($request->get('codigo'));
        $materiaprimas->nombre = strtoupper($request->get('nombre'));
        $materiaprimas->unidadmedidas_id = $request->get('unidadmedidas_id');
        $materiaprimas->fraccionable = (boolean)$request->get('fraccionable');
        $bitacoras = new Bitacora;
        $bitacoras->register($bitacoras, 'U', $materiaprimas->nombre, $materiaprimas->id, 'materiaprimas', auth()->user()->id);
        $materiaprimas->update();
        session()->flash('message', 'Materia Prima actualizada!');
        return redirect()->route('materiaprimas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $materiaprimas
     * @return \Illuminate\Http\Response
     */
    public function destroy(MateriaPrima $materiaprimas)
    {
        try {
            $materiaprimas->delete();
            $bitacoras = new Bitacora;
            $bitacoras->register($bitacoras, 'D', $materiaprimas->nombre, $materiaprimas->id, 'materiaprimas', auth()->user()->id);
            session()->flash('message', 'Materia Prima eliminada!');
            return redirect()->route('materiaprimas.index');
        }
        catch (\Illuminate\Database\QueryException $e) {
            if($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No puede eliminar materia prima, posee información relacionada');
                return redirect()->route('materiaprimas.index');
            }
        }
    }
}
