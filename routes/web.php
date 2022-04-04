<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\ConsultaUsersController; 
use App\http\Controllers\CrudUsuarioController;
use App\http\Controllers\AreaController;
use App\http\Controllers\familyController;
use App\http\Controllers\itemController;
use App\http\Controllers\loginController;
use App\http\Controllers\operationController;
use App\http\Controllers\warrantyRulesController;
use App\http\Controllers\ChecklistController;
use App\http\Controllers\InspectorController;
use App\http\Controllers\SupervisorController
;



use Illuminate\Http\Request;
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

/*Route::get('/', [ConsultaUsersController::class,'ConsultaUsuario']);
Route::get('formularioUsuario',function (){
  return view('formularioUsuario');
});
Route::post('NuevoRegistro', [CrudUsuarioController::class,'UsuarioModel']);
Route::get('destroy/{id}', [CrudUsuarioController::class,'destroy']);
Route::get('edit/{id}', [CrudUsuarioController::class,'edit']);


Route::get('/test', function () {
  return response()->json([
      'response' => 'Funcionando...'
  ]);
});*/

// ------------------------------ RUTAS DE LA MATRIX -------------------------------- //
// ------------------------------ RUTAS DE LA MATRIX -------------------------------- //
// ------------------------------ RUTAS DE LA MATRIX -------------------------------- //
// ------------------------------ RUTAS DE LA MATRIX -------------------------------- //
// ------------------------------ RUTAS DE LA MATRIX -------------------------------- //
// ------------------------------ RUTAS DE LA MATRIX -------------------------------- //

// ------------------------------ RUTAS DE CRUD DE USUARIO-------------------------------------- //
Route::get('users', [CrudUsuarioController::class,'users']);
Route::post('userInsert', [CrudUsuarioController::class,'userInsert']);
Route::post('userUpdate', [CrudUsuarioController::class,'userUpdate']);
Route::post('userDelete', [CrudUsuarioController::class,'userDelete']);

// ------------------------------ RUTAS DE CRUD DE AREAS-------------------------------------- //
Route::get('areas', [AreaController::class,'areas']);
Route::get('areaSelect', [AreaController::class,'areaSelect']);
Route::post('areaInsert', [AreaController::class,'areaInsert']);
Route::post('areaUpdate', [AreaController::class,'areaUpdate']);
Route::post('areadelete', [AreaController::class,'Areadelete']);

// ------------------------------ RUTAS DE CRUD DE OPERACION-------------------------------------- //
Route::get('operation', [operationController::class,'operation']);
Route::get('operationSelect', [operationController::class,'operationSelect']);
Route::post('operationInsert', [operationController::class,'operationInsert']);
Route::post('operationUpdate', [operationController::class,'operationUpdate']);
Route::post('operationDelete', [operationController::class,'operationDelete']);

// ------------------------------ RUTAS DE CRUD DE FAMILIA-------------------------------------- //
Route::get('familys', [familyController::class,'familys']);
Route::get('familySelect', [familyController::class,'familySelect']);
Route::post('familyInsert', [familyController::class,'familyInsert']);
Route::post('familyUpdate', [familyController::class,'familyUpdate']);
Route::post('familydelete', [familyController::class,'familydelete']);

// ------------------------------ RUTAS DE CRUD DE ITEM-------------------------------------- //
Route::get('item', [itemController::class,'item']);
Route::get('itemSelect', [itemController::class,'itemSelect']);
Route::post('itemInsert', [itemController::class,'itemInsert']);
Route::post('itemUpdate', [itemController::class,'itemUpdate']);
Route::post('itemdelete', [itemController::class,'itemdelete']);

// ------------------------------ RUTAS DE CRUD DE REGLAS DE GARANTIA-------------------------------------- //
Route::get('warrantyRules', [warrantyRulesController::class,'warrantyRules']);
Route::get('warrantyRuleSelect', [warrantyRulesController::class,'warrantyRuleSelect']);
Route::post('warrantyRuleInsert', [warrantyRulesController::class,'warrantyRuleInsert']);
Route::post('warrantyRulesUpdate', [warrantyRulesController::class,'warrantyRulesUpdate']);
Route::post('warrantyRulesdelete', [warrantyRulesController::class,'warrantyRulesdelete']);
Route::post('warrantyRulesChecksUpdate', [warrantyRulesController::class,'warrantyRulesChecksUpdate']);

// ------------------------------ RUTA DE LOGIN-------------------------------------- //
Route::post('login', [loginController::class,'login']);
// ------------------------------ RUTA DE CHECKLIST-------------------------------------- //
Route::get('checklist', [ChecklistController::class,'checklist']);
Route::get('InspectorAnswer', [ChecklistController::class,'InspectorAnswer']);
Route::get('NoContestado', [ChecklistController::class,'NoContestado']);
Route::get('Contestado', [ChecklistController::class,'Contestado']);
Route::get('Correctas', [ChecklistController::class,'Correctas']);
Route::get('Incorrectas', [ChecklistController::class,'Incorrectas']);
Route::get('reglasGarantiaSelect', [ChecklistController::class,'reglasGarantiaSelect']);
Route::get('InspectChecklist', [ChecklistController::class,'InspectChecklist']);
Route::post('checklistInsert', [ChecklistController::class,'checklistInsert']);
Route::post('checklistUpdate', [ChecklistController::class,'checklistUpdate']);
Route::post('checklistdelete', [ChecklistController::class,'checklistdelete']);
Route::post('estadoUpdate', [ChecklistController::class,'estadoUpdate']);

// ------------------------------ RUTA DE INSPECTOR-------------------------------------- //
Route::post('inspectInsert', [InspectorController::class,'inspectInsert']);

// ------------------------------ RUTA DE BACKUP-------------------------------------- //
Route::post('Respaldo', [SupervisorController::class,'Respaldo']);
Route::post('Copia', [SupervisorController::class,'Copia']);











