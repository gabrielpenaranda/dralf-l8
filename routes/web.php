<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->prefix('dralf')->group(function()
{
  Route::resource('usuarios', 'UsuarioController');
  
  Route::resource('roles', 'RolController');

  Route::get('/', 'AdminController@index')->name('admin.index');

  Route::prefix('ciudades')->group(function()
  {
    Route::get('/', 'CiudadController@index')->name('ciudades.index')->middleware('permission:ciudades.index');
    Route::get('/create', 'CiudadController@create')->name('ciudades.create')->middleware('permission:ciudades.create');
    Route::post('/store', 'CiudadController@store')->name('ciudades.store');
    Route::delete('/destroy/{ciudades}', 'CiudadController@destroy')->name('ciudades.destroy')->middleware('permission:ciudades.destroy');
    Route::get('/edit/{ciudades}', 'CiudadController@edit')->name('ciudades.edit')->middleware('permission:ciudades.edit');
    Route::put('/update/{ciudades}', 'CiudadController@update')->name('ciudades.update');
  });

  Route::prefix('cobros')->group(function()
  {
    Route::get('/{modulo}', 'CobroController@index')->name('cobros.index');
    Route::get('/create/{facturas}/{modulo}', 'CobroController@create')->name('cobros.create');
    Route::post('/store/{modulo}', 'CobroController@store')->name('cobros.store');
    Route::get('/show/{facturas}/{modulo}', 'CobroController@show')->name('cobros.show');
    Route::delete('/destroy/{facturas}', 'CobroController@destroy')->name('cobros.destroy');
    Route::get('/edit/{facturas}', 'CobroController@edit')->name('cobros.edit');
    Route::put('/update/{facturas}', 'CobroController@update')->name('cobros.update');
    Route::get('/facturas-canceladas/{modulo}', 'CobroController@facturas_canceladas')->name('cobros.facturas-canceladas');
  });

  Route::prefix('detailfacturas')->group(function()
  {
    Route::get('/{facturas}/{modulo}', 'DetailFacturaController@index')->name('detailfacturas.index');
    Route::get('/create/{facturas}/{modulo}', 'DetailFacturaController@create')->name('detailfacturas.create');
    Route::post('/store/{modulo}', 'DetailFacturaController@store')->name('detailfacturas.store');
    Route::get('/show/{facturas}', 'DetailFacturaController@show')->name('detailfacturas.show');
    Route::delete('/destroy/{facturas}', 'DetailFacturaController@destroy')->name('detailfacturas.destroy');
    Route::get('/edit/{facturas}', 'DetailFacturaController@edit')->name('detailfacturas.edit');
    Route::put('/update/{facturas}/{modulo}', 'DetailFacturaController@update')->name('detailfacturas.update');
  });

  Route::prefix('divisas')->group(function()
  {
    Route::get('/', 'DivisaController@index')->name('divisas.index');
    Route::get('/create', 'DivisaController@create')->name('divisas.create');
    Route::post('/store', 'DivisaController@store')->name('divisas.store');
    Route::delete('/destroy/{divisas}', 'DivisaController@destroy')->name('divisas.destroy');
    Route::get('/edit/{divisas}', 'DivisaController@edit')->name('divisas.edit');
    Route::put('/update/{divisas}', 'DivisaController@update')->name('divisas.update');
  });

  Route::prefix('entregas')->group(function()
  {
    Route::get('/', 'EntregaController@index')->name('entregas.index');
    Route::get('/menu', 'EntregaController@menu')->name('entregas.menu');
    Route::get('/create/{factura}/{modulo}', 'EntregaController@create')->name('entregas.create');
    Route::post('/store/{modulo}', 'EntregaController@store')->name('entregas.store');
    Route::get('/show/{facturas}', 'EntregaController@show')->name('entregas.show');
    Route::delete('/destroy/{facturas}', 'EntregaController@destroy')->name('entregas.destroy');
    Route::get('/edit/{facturas}', 'EntregaController@edit')->name('entregas.edit');
    Route::put('/update/{facturas}', 'EntregaController@update')->name('entregas.update');
    Route::get('/delivery', 'EntregaController@delivery')->name('entregas.delivery');
    Route::get('/show-delivery', 'EntregaController@show_delivery')->name('entregas.show_delivery');
    Route::get('/show-delivery-detail/{facturas}/{modulo}', 'EntregaController@show_delivery_detail')->name('entregas.show_delivery_detail');
    Route::get('/selectdelivery/{facturas}/{modulo}', 'EntregaController@selectdelivery')->name('entregas.selectdelivery');
    Route::get('/createdelivery/{entregas}/{modulo}', 'EntregaController@createdelivery')->name('entregas.createdelivery');
    Route::post('/storedelivery/{modulo}', 'EntregaController@storedelivery')->name('entregas.storedelivery');
    Route::get('/showdelivery', 'EntregaController@showdelivery')->name('entregas.showdelivery');
  });

  // Route::prefix('entregas')->group(function()
// {
//     Route::get('/', 'EntregaController@index')->name('entregas.index');
//     Route::get('/create', 'EntregaController@create')->name('entregas.create');
//     Route::post('/store', 'EntregaController@store')->name('entregas.store');
//     Route::delete('/destroy/{entrega}', 'EntregaController@destroy')->name('entregas.destroy');
//     Route::get('/edit/{entrega}', 'EntregaController@edit')->name('entregas.edit');
//     Route::put('/update/{entrega}', 'EntregaController@update')->name('entregas.update');
// });

  Route::prefix('estados')->group(function()
  {
    Route::get('/', 'EstadoController@index')->name('estados.index');
    Route::get('/create', 'EstadoController@create')->name('estados.create');
    Route::post('/store', 'EstadoController@store')->name('estados.store');
    Route::delete('/destroy/{estados}', 'EstadoController@destroy')->name('estados.destroy');
    Route::get('/edit/{estados}', 'EstadoController@edit')->name('estados.edit');
    Route::put('/update/{estados}', 'EstadoController@update')->name('estados.update');
  });

  Route::prefix('facturas')->group(function()
  {
    Route::get('/{modulo}', 'FacturaController@index')->name('facturas.index');
    Route::get('/create/{modulo}', 'FacturaController@create')->name('facturas.create');
    Route::post('/store/{modulo}', 'FacturaController@store')->name('facturas.store');
    Route::get('/show/{facturas}/{modulo}', 'FacturaController@show')->name('facturas.show');
    Route::delete('/destroy/{facturas}', 'FacturaController@destroy')->name('facturas.destroy');
    Route::get('/edit/{facturas}', 'FacturaController@edit')->name('facturas.edit');
    Route::put('/update/{facturas}', 'FacturaController@update')->name('facturas.update');
    Route::post('/ftercero/{modulo}', 'FacturaController@ftercero')->name('facturas.ftercero');
    Route::post('/fproducto/{terceros}/{facturas}/{modulo}', 'FacturaController@fproducto')->name('facturas.fproducto');
    Route::get('/fstore/{terceros}/{facturas}/{modulo}', 'FacturaController@fstore')->name('facturas.fstore');
    Route::get('/fdestroy/{facturas}/{modulo}', 'FacturaController@fdestroy')->name('facturas.fdestroy');
    Route::get('/freverse/{facturas}/{modulo}', 'FacturaController@freverse')->name('facturas.freverse');
    Route::get('/fproductodestroy/{terceros}/{facturas}/{detalle}/{modulo}', 'FacturaController@fproductodestroy')->name('facturas.fproductodestroy');
    Route::get('/fprint/{facturas}/{modulo}', 'FacturaController@fprint')->name('facturas.fprint');
  });

  Route::prefix('formulas')->group(function()
  {
    Route::get('/', 'FormulaController@index')->name('formulas.index');
    Route::get('/create', 'FormulaController@create')->name('formulas.create');
    Route::post('/store', 'FormulaController@store')->name('formulas.store');
    Route::delete('/destroy/{formulas}', 'FormulaController@destroy')->name('formulas.destroy');
    Route::get('/edit/{formulas}', 'FormulaController@edit')->name('formulas.edit');
    Route::put('/update/{formulas}', 'FormulaController@update')->name('formulas.update');
  });

  Route::prefix('lotes')->group(function()
  {
    Route::get('/', 'LoteController@index')->name('lotes.index');
    Route::get('/create', 'LoteController@create')->name('lotes.create');
    Route::post('/store', 'LoteController@store')->name('lotes.store');
    Route::delete('/destroy/{lotes}', 'LoteController@destroy')->name('lotes.destroy');
    Route::get('/edit/{lotes}', 'LoteController@edit')->name('lotes.edit');
    Route::put('/update/{lotes}', 'LoteController@update')->name('lotes.update');
    Route::get('/certify/{lotes}', 'LoteController@certify')->name('lotes.certify');
    Route::get('/print/{lotes}', 'LoteController@print')->name('lotes.print');
  });

  Route::prefix('materiaprimas')->group(function()
  {
    Route::get('/', 'MateriaPrimaController@index')->name('materiaprimas.index');
    Route::get('/create', 'MateriaPrimaController@create')->name('materiaprimas.create');
    Route::post('/store', 'MateriaPrimaController@store')->name('materiaprimas.store');
    Route::delete('/destroy/{materiaprimas}', 'MateriaPrimaController@destroy')->name('materiaprimas.destroy');
    Route::get('/edit/{materiaprimas}', 'MateriaPrimaController@edit')->name('materiaprimas.edit');
    Route::get('/update/{materiaprimas}', 'MateriaPrimaController@update')->name('materiaprimas.update');
  });

  Route::prefix('notaentregas')->group(function()
  {
    Route::get('/{modulo}', 'NotaEntregaController@index')->name('notaentregas.index');
    Route::get('/create/{modulo}', 'NotaEntregaController@create')->name('notaentregas.create');
    Route::post('/store/{modulo}', 'NotaEntregaController@store')->name('notaentregas.store');
    Route::get('/show/{facturas}/{modulo}', 'NotaEntregaController@show')->name('notaentregas.show');
    Route::delete('/destroy/{facturas}', 'NotaEntregaController@destroy')->name('notaentregas.destroy');
    Route::get('/edit/{facturas}', 'NotaEntregaController@edit')->name('notaentregas.edit');
    Route::put('/update/{facturas}', 'NotaEntregaController@update')->name('notaentregas.update');
  });

  // Route::prefix('pagos')->group(function()
  // {
  //   Route::get('/', 'PagoController@index')->name('pagos.index');
  //   Route::get('/create', 'PagoController@create')->name('pagos.create');
  //   Route::post('/store', 'PagoController@store')->name('pagos.store');
  //   Route::delete('/destroy/{pago}', 'PagoController@destroy')->name('pagos.destroy');
  //   Route::get('/edit/{pago}', 'PagoController@edit')->name('pagos.edit');
  //   Route::put('/update/{pago}', 'PagoController@update')->name('pagos.update');
  // });

  Route::prefix('personas')->group(function()
  {
    Route::get('/', 'PersonaController@index')->name('personas.index');
    Route::get('/create', 'PersonaController@create')->name('personas.create');
    Route::post('/store', 'PersonaController@store')->name('personas.store');
    Route::delete('/destroy/{personas}', 'PersonaController@destroy')->name('personas.destroy');
    Route::get('/edit/{personas}', 'PersonaController@edit')->name('personas.edit');
    Route::put('/update/{personas}', 'PersonaController@update')->name('personas.update');
  });

  Route::prefix('productos')->group(function()
  {
    Route::get('/', 'ProductoController@index')->name('productos.index');
    Route::get('/create', 'ProductoController@create')->name('productos.create');
    Route::post('/store', 'ProductoController@store')->name('productos.store');
    Route::delete('/destroy/{productos}', 'ProductoController@destroy')->name('productos.destroy');
    Route::get('/edit/{productos}', 'ProductoController@edit')->name('productos.edit');
    Route::put('/update/{productos}', 'ProductoController@update')->name('productos.update');
    Route::get('/show/{productos}', 'ProductoController@show')->name('productos.show');
  });

  Route::prefix('pruebas')->group(function()
  {
    Route::get('/', 'PruebaController@index')->name('pruebas.index');
    Route::get('/create', 'PruebaController@create')->name('pruebas.create');
    Route::post('/store', 'PruebaController@store')->name('pruebas.store');
    Route::delete('/destroy/{prueba}', 'PruebaController@destroy')->name('pruebas.destroy');
    Route::get('/edit/{pruebas}', 'PruebaController@edit')->name('pruebas.edit');
    Route::put('/update/{pruebas}', 'PruebaController@update')->name('pruebas.update');
    Route::get('/show/{pruebas}', 'PruebaController@show')->name('pruebas.show');
  });
  
  Route::prefix('pruebaanticoagulantes')->group(function()
  {
    Route::get('/', 'PruebaAnticoagulanteController@index')->name('pruebaanticoagulantes.index');
    Route::get('/create', 'PruebaAnticoagulanteController@create')->name('pruebaanticoagulantes.create');
    Route::post('/store', 'PruebaAnticoagulanteController@store')->name('pruebaanticoagulantes.store');
    Route::delete('/destroy/{pruebaanticoagulantes}', 'PruebaAnticoagulanteController@destroy')->name('pruebaanticoagulantes.destroy');
    Route::get('/edit/{pruebaanticoagulantes}', 'PruebaAnticoagulanteController@edit')->name('pruebaanticoagulantes.edit');
    Route::put('/update/{pruebaanticoagulantes}', 'PruebaAnticoagulanteController@update')->name('pruebaanticoagulantes.update');
    Route::get('/show/{pruebaanticoagulantes}', 'PruebaAnticoagulanteController@show')->name('pruebaanticoagulantes.show');
  });

  Route::prefix('pruebadiluentes')->group(function()
  {
    Route::get('/', 'PruebaDiluenteController@index')->name('pruebadiluentes.index');
    Route::get('/create', 'PruebaDiluenteController@create')->name('pruebadiluentes.create');
    Route::post('/store', 'PruebaDiluenteController@store')->name('pruebadiluentes.store');
    Route::delete('/destroy/{pruebadiluentes}', 'PruebaDiluenteController@destroy')->name('pruebadiluentes.destroy');
    Route::get('/edit/{pruebadiluentes}', 'PruebaDiluenteController@edit')->name('pruebadiluentes.edit');
    Route::put('/update/{pruebadiluentes}', 'PruebaDiluenteController@update')->name('pruebadiluentes.update');
    Route::get('/show/{pruebadiluentes}', 'PruebaDiluenteController@show')->name('pruebadiluentes.show');
  });

  Route::prefix('pruebalisantes')->group(function()
  {
    Route::get('/', 'PruebaLisanteController@index')->name('pruebalisantes.index');
    Route::get('/create', 'PruebaLisanteController@create')->name('pruebalisantes.create');
    Route::post('/store', 'PruebaLisanteController@store')->name('pruebalisantes.store');
    Route::delete('/destroy/{pruebalisantes}', 'PruebaLisanteController@destroy')->name('pruebalisantes.destroy');
    Route::get('/edit/{pruebalisantes}', 'PruebaLisanteController@edit')->name('pruebalisantes.edit');
    Route::put('/update/{pruebalisantes}', 'PruebaLisanteController@update')->name('pruebalisantes.update');
    Route::get('/show/{pruebalisantes}', 'PruebaLisanteController@show')->name('pruebalisantes.show');
  });

  Route::prefix('pruebarinses')->group(function()
  {
    Route::get('/', 'PruebaRinseController@index')->name('pruebarinses.index');
    Route::get('/create', 'PruebaRinseController@create')->name('pruebarinses.create');
    Route::post('/store', 'PruebaRinseController@store')->name('pruebarinses.store');
    Route::delete('/destroy/{pruebarinses}', 'PruebaRinseController@destroy')->name('pruebarinses.destroy');
    Route::get('/edit/{pruebarinses}', 'PruebaRinseController@edit')->name('pruebarinses.edit');
    Route::put('/update/{pruebarinses}', 'PruebaRinseController@update')->name('pruebarinses.update');
    Route::get('/show/{pruebarinses}', 'PruebaRinseController@show')->name('pruebarinses.show');
  });

  Route::prefix('reportefacturas')->group(function()
  {
    Route::get('/', 'ReporteFacturaController@index')->name('reportefacturas.index');
    Route::get('/iva', 'ReporteFacturaController@report_iva_index')->name('reportefacturas.iva-index');
    Route::post('/iva-show', 'ReporteFacturaController@report_iva_show')->name('reportefacturas.iva-show');
    Route::get('/factura', 'ReporteFacturaController@report_factura_index')->name('reportefacturas.factura-index');
    Route::post('/factura-show', 'ReporteFacturaController@report_factura_show')->name('reportefacturas.factura-show');
  });

  Route::prefix('terceros')->group(function()
  {
    Route::get('/', 'TerceroController@index')->name('terceros.index');
    Route::get('/create', 'TerceroController@create')->name('terceros.create');
    Route::post('/store', 'TerceroController@store')->name('terceros.store');
    Route::delete('/destroy/{terceros}', 'TerceroController@destroy')->name('terceros.destroy');
    Route::get('/edit/{terceros}', 'TerceroController@edit')->name('terceros.edit');
    Route::put('/update/{terceros}', 'TerceroController@update')->name('terceros.update');
    Route::get('/show/{terceros}', 'TerceroController@show')->name('terceros.show');
  });

  Route::prefix('tipopersonas')->group(function()
  {
    Route::get('/', 'TipoPersonaController@index')->name('tipopersonas.index');
    Route::get('/create', 'TipoPersonaController@create')->name('tipopersonas.create');
    Route::post('/store', 'TipoPersonaController@store')->name('tipopersonas.store');
    Route::delete('/destroy/{tipopersonas}', 'TipoPersonaController@destroy')->name('tipopersonas.destroy');
    Route::get('/edit/{tipopersonas}', 'TipoPersonaController@edit')->name('tipopersonas.edit');
    Route::put('/update/{tipopersonas}', 'TipoPersonaController@update')->name('tipopersonas.update');
  });

  Route::prefix('tipoproductos')->group(function()
  {
    Route::get('/', 'TipoProductoController@index')->name('tipoproductos.index');
    Route::get('/create', 'TipoProductoController@create')->name('tipoproductos.create');
    Route::post('/store', 'TipoProductoController@store')->name('tipoproductos.store');
    Route::delete('/destroy/{tipoproductos}', 'TipoProductoController@destroy')->name('tipoproductos.destroy');
    Route::get('/edit/{tipoproductos}', 'TipoProductoController@edit')->name('tipoproductos.edit');
    Route::put('/update/{tipoproductos}', 'TipoProductoController@update')->name('tipoproductos.update');
  });

  Route::prefix('unidadmedidas')->group(function()
  {
    Route::get('/', 'UnidadMedidaController@index')->name('unidadmedidas.index');
    Route::get('/create', 'UnidadMedidaController@create')->name('unidadmedidas.create');
    Route::post('/store', 'UnidadMedidaController@store')->name('unidadmedidas.store');
    Route::delete('/destroy/{unidadmedidas}', 'UnidadMedidaController@destroy')->name('unidadmedidas.destroy');
    Route::get('/edit/{unidadmedidas}', 'UnidadMedidaController@edit')->name('unidadmedidas.edit');
    Route::put('/update/{unidadmedidas}', 'UnidadMedidaController@update')->name('unidadmedidas.update');
  });

});

Route::get('/home', 'HomeController@index')->name('home');
