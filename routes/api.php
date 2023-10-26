<?php

use App\Http\Controllers\configContrller;
use App\Http\Controllers\Controller;
use App\Http\Controllers\generalController;
use App\Http\Controllers\lavadoController;
use App\Http\Controllers\obsMaquinaController;
use App\Http\Controllers\registroController;
use App\Http\Controllers\stock_siloController;
use App\Http\Controllers\userController;
use App\Http\Controllers\vencimientoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */
Route::post('repassword',[userController::class,'store_repassword'])->name('repassword');
Route::get('view_repassword',[userController::class,'get_view_repassword'])->name('view_repassword');
Route::post('login',[userController::class,'login'])->name('login');
Route::middleware('auth:sanctum','ability:general')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware'=>['auth:sanctum','ability:general']],function(){
    Route::post('insert_registro',[registroController::class,'insert'])->name('registro.insertar');
    Route::post('delete_registro',[registroController::class,'delete_reg'])->name('registro.borrar');
    Route::post('edit_registro',[registroController::class,'edit_reg'])->name('registro.editar');
    Route::get('search_registro_pendiente',[registroController::class,'search_pending_byUser'])->name('registro.buscar.pendiente');
    Route::get('search_registro_by_id',[registroController::class,'search_by_id'])->name('registro.buscar.por.id');
    Route::get('search_registro_by_date',[registroController::class,'search_by_date'])->name('registro.buscar.porDia');
    Route::get('logout',[userController::class,'logout'])->name('cerrar');
    //tabla vencimiento
    Route::post('insert_vencimiento', [vencimientoController::class,'insert_reg'])->name('vencimiento.insertar');
    Route::post('edit_vencimiento', [vencimientoController::class,'edit_reg'])->name('vencimiento.editar');
    Route::post('delete_vencimiento', [vencimientoController::class,'delete_reg'])->name('vencimiento.eliminar');
    Route::get('search_form_vencimiento',[generalController::class,'search_form_vencimiento'])->name('vencimiento.search');
    //tabla lavados
    Route::post('insert_lavado', [lavadoController::class,'ingresar'])->name('lavado.insertar');
    Route::post('delete_lavado', [lavadoController::class,'eliminar'])->name('lavado.eliminar');
    Route::get('search_form_lavado',[generalController::class,'search_form_lavado'])->name('lavado.search');

    //tabla stock_silos
    Route::post('insert_stock_silo', [stock_siloController::class,'ingresar'])->name('stock_silo.insertar');
    Route::post('delete_stock_silo', [stock_siloController::class,'eliminar'])->name('stock_silo.eliminar');
    Route::get('search_form_stock',[generalController::class,'search_form_stock'])->name('stock_silo.search');

    //tabla obs_maquina
    Route::post('insert_obs_maquina', [obsMaquinaController::class,'ingresar'])->name('obs_maquina.insertar');
    Route::post('delete_obs_maquina', [obsMaquinaController::class,'eliminar'])->name('obs_maquina.eliminar');
    Route::get('search_idobs_maquina',[obsMaquinaController::class,'buscar'])->name('obs_maquina.search.id');
    Route::get('search_form_obs_maquina',[generalController::class,'search_form_obs_maquina'])->name('obs_maquina.search');


//informes
   Route::get('info_html',[generalController::class,'info_html'])->name('html.info');
   Route::get('send_mail',[generalController::class,'send_mail'])->name('mail.info');


});
Route::group(['middleware' =>['auth:sanctum','ability:admin']],function(){
 //configuracion
   Route::post('config_insert',[configContrller::class,'insertar_config'])->name('config.insert');
   Route::post('config_delete',[configContrller::class,'borrar_config'])->name('config.delete');
   Route::get('config_view',[configContrller::class,'view_component'])->name('config.view');
});
