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
    return redirect('login');
});

Route::get('/temp',function (){
    $tablas = ['ventas','detalle_ventas','ingresos','gastos','cortes','credito','compras','compra_inventario'];
    foreach ($tablas as $value) {
        DB::select('SET FOREIGN_KEY_CHECKS = 0');
        DB::select('TRUNCATE '.$value);
        DB::select('SET FOREIGN_KEY_CHECKS = 1');
    }
    $empresa = \App\Empresa::find(1);
        $empresa->ingresos = 0.00; $empresa->egresos = 0.00; $empresa->caja_extra = 0.00;
    $empresa->update();
    return 'listo';
});

Auth::routes();

Route::get('logout', 'Auth\LoginController@logout')->name('logout' );
Route::get('home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function(){
    //RUTAS METODO GET

    //EXCEL
    Route::get('excel','ExcelController@index');
    Route::get('excel/clientes','ExcelController@exportClientes')->name('export.clientes');

    //MESAS
    Route::get('mesas/gestionar','MesasController@indexMesas');

    //COMPRA
    Route::get('compra/getIng/{id}','CompraController@getIng');
    Route::get('compra/exitosas','CompraController@exitosas');
    Route::get('compra/canceladas','CompraController@canceladas');

    //CLIENTE Y CREDITO
    Route::get('cliente/detalle/{id}','ClienteController@detalleVentas');
    Route::get('credito/cliente/{id}','CreditoController@ventasCredito')->name('credito.cliente');

    //EMPRESA
    Route::get('empresa','EmpresaController@edit');
    Route::put('empresa/{id}','EmpresaController@update')->name('empresa.update');

    //TRUNCAR
    Route::get('truncar','UtilidadesController@truncar');

    //COBRO
    Route::get('cobro','CobroController@index');
    Route::get('cobro/getVentas','CobroController@fgetVentas');
    Route::post('cobro/pagarCuenta','CobroController@pagoVenta')->name('cobro.pagoVenta');

    Route::get('clientes',function(){ return \App\Cliente::all(); });
    Route::get('mesas/limpiarMesa/{id}','MesasController@flimpiarMesa');

    //VENTA
    Route::get('venta','VentaController@index');
    Route::get('venta/exitosas','VentaController@exitosas');
    Route::get('venta/canceladas','VentaController@canceladas');
    Route::get('venta/pendientes','VentaController@pendientes');
    Route::get('venta/show/{id}','VentaController@show')->name('venta.show');

    //TICKET
    Route::get('ticket/compra/{id}','TicketController@ticketCliente');
    Route::get('ticket/cocina/{id}','TicketController@ticketCocina');
    
    Route::get('pass/{id}','UtilidadesController@pass');
    Route::put('changePass/{id}','UtilidadesController@changePass');
    Route::get('concretarpedido/{venta}','UtilidadesController@pedidoConcretar');
    Route::get('cancelar/sperdidas/{venta}','UtilidadesController@CancelarSPerdidas');
    Route::get('cancelar/cperdidas/{venta}','UtilidadesController@CancelarCPerdidas');

    //REPORTES
    Route::get('reportes/ventas','ReportesController@ventas');
    Route::get('reportes/compras','ReportesController@compras');
    Route::post('reportes/getSales','ReportesController@getSalesByDates');
    Route::post('reportes/getShops','ReportesController@getShopsByDates');
    Route::post('reportes/dataPDF','ReportesController@dataPDF');
    Route::get('reportes/graphs','ReportesController@graphs');
    Route::get('reportes/graphs/sales/{opcion}','ReportesController@graphsDataSales');
    Route::get('reportes/graphs/products/{opcion}','ReportesController@graphsDataProducts');

    //CORTES
    Route::get('cortes','CortesController@index');
    Route::get('cortes/show/{id}','CortesController@show');
    Route::post('cortes','CortesController@store');
    Route::get('cortes/ventas','CortesController@showVentas');
    Route::get('cortes/getVentasCortes','CortesController@getVentasCortes');
    Route::get('cortes/getComprasCortes','CortesController@getComprasCortes');
    Route::get('cortes/getCortes','CortesController@getCortes');

    //UNIDAD
    Route::get('unidad','UnidadesController@index');
    Route::get('unidad/getUnidades','UnidadesController@getUnidades');
    Route::delete('unidad/{id}','UnidadesController@destroy');
    Route::put('unidad/{id}','UnidadesController@update');
    Route::post('unidad','UnidadesController@store');

    //INVENTARIO
    Route::get('inventario/reabastecer', 'InventarioController@reabastecer');
    Route::post('inventario/reabastecer', 'InventarioController@reabastecerStore');
    Route::get('inventario/getIngs', function(){ return \App\Inventario::where('status','=','Activo')->get(); });
    Route::get('inventario/existencia','UtilidadesController@existencia');

    //RUTAS METODO RESOURCE
    Route::resource('/checkbox','CheckController');
    Route::resource('user','UserController');
    Route::resource('test','TestController');
    Route::resource('inventario','InventarioController');
    Route::resource('producto','ProductoController');
    Route::resource('categoria','CategoriaController');
    Route::resource('cliente','ClienteController');
    Route::resource('mesas','MesasController');
    Route::resource('comandas','ComandaController');
    Route::resource('subcategoria','SubcategoriaController');
    Route::resource('pedido','PedidoController');
    Route::resource('proovedor','ProovedorController');
    Route::resource('compra','CompraController');
    Route::resource('credito','CreditoController');
    Route::resource('gasto','GastoController');
    Route::resource('ingreso','IngresoController');

    //=====Rutas JavaScript=====

    Route::get('ingSelect/{id}','UtilidadesController@ingSelect');
    Route::get('subcats/{id}','UtilidadesController@subCats'); 
    Route::get('selcategorias/{id}','UtilidadesController@selectCat');
    Route::get('selsubcategorias/{id}','UtilidadesController@selectSub');
    Route::get('getStock/{id}','UtilidadesController@getStock');
    Route::get('getProducto/{id}','UtilidadesController@getProducto');
    Route::get('getCategorias', function(){ return \App\Categoria::orderBy('name', 'asc')->get(); });
    Route::get('getClientes','UtilidadesController@clientesSelect');
    Route::get('getFormClientes', function(){ return view('cliente.forms.form'); });
    Route::get('comandas/getVentaComanda/{id}', 'ComandaController@getComanda');
    Route::get('pedido/getVentaPedido/{id}', 'PedidoController@getPedido');
    Route::post('descuento', 'PedidoController@descuento');
    Route::get('unique/{nombre}', function($nombre){ return \App\Producto::where('name','=',$nombre)->get(); });
    Route::get('getUnidades', function(){ return \App\Unidad::all(); });
    Route::get('getArticulos', function(){ return \App\Inventario::where('status','=','Activo')->orderBy('created_at','desc')->get(); });
    Route::get('getProovedores', function(){ return \App\Proovedor::orderBy('created_at','desc')->get(); });

    //Roles
	Route::post('roles/store', 'RoleController@store')->name('roles.store')->middleware('permission:roles.create');
    Route::get('roles', 'RoleController@index')->name('roles.index')->middleware('permission:roles.index');
    Route::get('roles/create', 'RoleController@create')->name('roles.create')->middleware('permission:roles.create');
    Route::put('roles/{role}', 'RoleController@update')->name('roles.update')->middleware('permission:roles.edit');
    Route::get('roles/{role}', 'RoleController@show')->name('roles.show')->middleware('permission:roles.show');
    Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')->middleware('permission:roles.destroy');
    Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')->middleware('permission:roles.edit');
});