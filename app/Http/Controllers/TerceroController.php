<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateTerceroRequest;
use App\Http\Requests\UpdateTerceroRequest;
use App\Models\Tercero;
use App\Models\Bitacora;
use App\Models\Ciudad;
use App\Models\Persona;

class TerceroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terceros = Tercero::orderBy('nombre', 'asc')->paginate(7);
        return view('dralf.terceros.index')->with(['terceros' => $terceros]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $terceros = new Tercero;
        $ciudades = Ciudad::orderBy('nombre', 'asc')->get();
        $titulo = 'Crear Ciudad';
        return view('dralf.terceros.form')->with(['terceros' => $terceros, 'ciudades' => $ciudades, 'titulo' => $titulo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTerceroRequest $request)
    {
        $terceros = new Tercero;
        $terceros->rif = strtoupper($request->get('rif'));
        $terceros->nombre = strtoupper($request->get('nombre'));
        $terceros->direccion = strtoupper($request->get('direccion'));
        $terceros->razon_social = strtoupper($request->get('razon_social'));
        $terceros->email = strtolower($request->get('email'));
        $terceros->telefono = strtoupper($request->get('telefono'));
        $terceros->cliente = (bool)$request->get('cliente');
        $terceros->proveedor = (bool)$request->get('proveedor');
        $terceros->laboratorio = (bool)$request->get('laboratorio');
        $terceros->ciudades_id = $request->get('ciudades_id');
        $terceros->save();
        $bitacoras = new Bitacora;
        $bitacoras->register($bitacoras, 'C', $terceros->nombre, $terceros->id, 'terceros', auth()->user()->id);
        session()->flash('message', 'Tercero creado con éxito!');
        return redirect()->route('terceros.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $terceros
     * @return \Illuminate\Http\Response
     */
    public function show(Tercero $terceros)
    {
        $personas = Persona::where('terceros_id', $terceros->id)->orderBy('apellido', 'asc')->orderBy('nombre', 'asc')->get();
        return view('dralf.terceros.show')->with('terceros', $terceros)->with('personas', $personas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $terceros
     * @return \Illuminate\Http\Response
     */
    public function edit(Tercero $terceros)
    {
        $ciudades = Ciudad::orderBy('nombre', 'asc')->get();
        $titulo = 'Editar Ciudad';
        return view('dralf.terceros.form')->with(['terceros' => $terceros, 'ciudades' => $ciudades, 'titulo' => $titulo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $terceros
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTerceroRequest $request, Tercero $terceros)
    {
        $terceros->nombre = strtoupper($request->get('nombre'));
        $terceros->direccion = strtoupper($request->get('direccion'));
        $terceros->razon_social = strtoupper($request->get('razon_social'));
        $terceros->email = $request->get('email');
        $terceros->telefono = strtoupper($request->get('telefono'));
        $terceros->cliente = (bool)$request->get('cliente');
        $terceros->proveedor = (bool)$request->get('proveedor');
        $terceros->laboratorio = (bool)$request->get('laboratorio');
        $terceros->ciudades_id = $request->get('ciudades_id');
        $terceros->update();
        $bitacoras = new Bitacora;
        $bitacoras->register($bitacoras, 'U', $terceros->nombre, $terceros->id, 'terceros', auth()->user()->id);
        session()->flash('message', 'Tercero actualizado!');
        return redirect()->route('terceros.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $terceros
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tercero $terceros)
    {
        try {
            $terceros->delete();
            $bitacoras = new Bitacora;
            $bitacoras->register($bitacoras, 'D', $terceros->nombre, $terceros->id, 'terceros', auth()->user()->id);
            session()->flash('message', 'Tercero eliminada!');
            return redirect()->route('terceros.index');
        }
        catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            if($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No puede eliminar tercero, posee información relacionada');
                return redirect()->route('terceros.index');
            }
        }
    }
}
