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

Route::get('/recipe/{recordId}', 'RecipeController@generate')->name('generateRecipe');
Route::get('/evolucion/{recordId?}/{id?}', 'RecipeController@evolution')->name('generateEvolution');
Route::get('/evolutionList/{recordId?}', 'RecipeController@evolutionList')->name('generateEvolutionList');
Route::post('/preRegistro', 'RecipeController@guardar')->name('preRegistro');
Route::post('/firmaGuardar', 'RecipeController@firma')->name('firmaGuardar');
Route::post('/firmaGuardarId', 'RecipeController@firmaId')->name('firmaGuardarId');
Route::post('/Consentimiento', 'Consentimiento@correo')->name('correo');
Route::get('/examen/{recordId}', 'ExamenController@generate')->name('generateExamen');
Route::get('/medicamento/{recordId}', 'MedicamentoController@generate')->name('generateExamen');
Route::get('/remision/{recordId}/{id_medico}/{presupuesto_id}', 'RemisionController@generate')->name('generateRemision');
Route::get('/presupuesto/{recordId}', 'PresupuestoController@generate')->name('generatePresupuesto');
Route::get('/presupuestopost/{recordId}', 'PresupuestoController@post')->name('generatePresupuestoPost');
Route::get('/factura/{recordId}/{date}', 'FaturaPagoController@generate')->name('generateFactura');
Route::get('/consentimiento/{recordId}/{id}', 'Consentimiento@generate')->name('generateConsentimiento');
Route::get('/rehabilitacion/{recordId}', 'Consentimiento@rehabilitacion')->name('generaterehabilitacion');
Route::get('/ortodoncia/{recordId}', 'Consentimiento@ortodoncia')->name('generateortodoncia');
Route::get('/endodoncia/{recordId}', 'Consentimiento@Endodoncia')->name('generateortodoncia');
Route::get('/ortodonciaPre/{recordId}', 'Consentimiento@OrtodonciaPre')->name('generateortodoncia');
Route::get('/drangelica/{recordId}', 'Consentimiento@draAngelica')->name('generatedraAngelica');
Route::get('/drangelica2/{recordId}', 'Consentimiento@draAngelica2')->name('generatedraAngelica2');
Route::get('/drangelica3/{recordId}', 'Consentimiento@draAngelica3')->name('generatedraAngelica3');
Route::get('/drboris/{recordId}', 'Consentimiento@drBoris')->name('generatedrBoris');
Route::get('/drjenny/{recordId}', 'Consentimiento@drJenny')->name('generatedrJenny');
Route::get('/colocacionmini/{recordId}', 'Consentimiento@colocacionMini')->name('generatecolocacionMini');
Route::get('/modelorx/{recordId}', 'Consentimiento@modelorx')->name('generatemodelorx');
// Route::get('/dataget', 'ToolsController@dataGet');
Route::get('/import', 'ToolsController@import');
Route::post('/importPatients', 'ToolsController@importPatients')->name('importPatients');
Route::post('/importRecords', 'ToolsController@importRecords')->name('importRecords');
Route::post('/importPhysical', 'ToolsController@importPhysical')->name('importPhysical');
Route::post('/importCito', 'ToolsController@importCito')->name('importCito');
Route::post('/importConclusions', 'ToolsController@importConclusions')->name('importConclusions');
Route::post('/importControls', 'ToolsController@importControls')->name('importControls');
Route::post('/importEvolutions', 'ToolsController@importEvolutions')->name('importEvolutions');
Route::post('/importIncomes', 'ToolsController@importIncomes')->name('importIncomes');
Route::post('/importAppointments', 'ToolsController@importAppointments')->name('importAppointments');
Route::get('/cobro/{recordId}', 'PresupuestoController@cobro')->name('cuentaPresupuesto');
Route::get('/cobroPost/{recordId}', 'PresupuestoController@cobroPost')->name('cuentaPresupuestoPost');
Route::get('/gasto/{recordId}', 'PresupuestoController@gasto')->name('gastos');
// //Clear Cache facade value:
// Route::get('/clear-cache', function() {
//     $exitCode = Artisan::call('cache:clear');
//     return '<h1>Cache facade value cleared</h1>';
// });

// //Reoptimized class loader:
// Route::get('/optimize', function() {
//     $exitCode = Artisan::call('optimize');
//     return '<h1>Reoptimized class loader</h1>';
// });

// //Route cache:
// Route::get('/route-cache', function() {
//     $exitCode = Artisan::call('route:cache');
//     return '<h1>Routes cached</h1>';
// });

// //Clear Route cache:
// Route::get('/route-clear', function() {
//     $exitCode = Artisan::call('route:clear');
//     return '<h1>Route cache cleared</h1>';
// });

// //Clear View cache:
// Route::get('/view-clear', function() {
//     $exitCode = Artisan::call('view:clear');
//     return '<h1>View cache cleared</h1>';
// });

// //Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

// //Clear Config cache:
Route::get('/generate-key', function() {
    $exitCode = Artisan::call('key:generate');
    return '<h1>Clear Config cleared</h1>';
});

Route::get('/config-clear', function () {
    $exitCode = Artisan::call('config:clear');
    return '<h1>Clear Config cleared</h1>';
});
