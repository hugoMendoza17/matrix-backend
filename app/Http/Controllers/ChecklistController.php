<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
Use App\GestionChecklist;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\json_decode;


class ChecklistController extends Controller
{
    public function checklist() {

        return DB::select('EXECUTE GestionChecklistGet');
    }
    public function reglasGarantiaSelect() {

        return DB::select('EXECUTE reglasGarantiaSelect');
    }
    public function InspectChecklist() {

        return DB::select('EXECUTE InspectChecklistGet');
    }
    public function NoContestado() {

        return DB::select('EXECUTE ChecklistNocontestado');
    }
    public function Contestado() {

        return DB::select('EXECUTE ChecklistContestado');
    }
    public function Correctas() {

        return DB::select('EXECUTE respuestasCorrectas');
    }
    public function Incorrectas() {

        return DB::select('EXECUTE respuestasIncorrectas');
    }
    public function InspectorAnswer() {

        return DB::select('EXECUTE respuestasInspector');
    }
    public function checklistInsert(Request $request){  
		if (!$request->input('nameArea') || !$request->input('namefamily') 
        || !$request->input('nameoperation') || !$request->input('nameItem') 
        || !$request->input('namerules') || !$request->input('nameChecklist')){
			// NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(
                [ 
                    'status'=>false,
                    'message'=> 'Faltan datos.',

                ],);
		}else {
            // Insertamos los datos recibidos en la tabla.
            $nameArea = $request->input('nameArea');
            $namefamily = $request->input('namefamily');
            $nameoperation = $request->input('nameoperation');
            $nameItem = $request->input('nameItem');
            $namerules = $request->input('namerules');
            $nameChecklist = $request->input('nameChecklist');
            DB::update("EXEC [sp_insertChecklist] '$nameArea', '$namefamily','$nameoperation','$nameItem' ,'$namerules','$nameChecklist'");
            $GestionChecklist = DB::select('SELECT * FROM GestionChecklist');
            return response()->json(
                    [ 
                        'status'=>true,
                        'message'=> 'Se registro correctamente.',
                        'data'=> $GestionChecklist
                    ],
                     201
                );
   
        }
    }
        //funcion para editar los checklists con la funcion EXEC llamamos al procedimiento //
    public function checklistUpdate(Request $request){
            
        if (!$request->input('id_gestionChecklist')){
            // NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['status'=> false,'message'
            =>'Ingresa el id correcto.'])]);		
        } else{
            
            $id_gestionChecklist = $request->input('id_gestionChecklist');
            $nameArea = $request->input('nameArea');
            $namefamily = $request->input('namefamily');
            $nameoperation = $request->input('nameoperation');
            $nameItem = $request->input('nameItem');
            $namerules = $request->input('namerules');
            $nameChecklist = $request->input('nameChecklist');

            DB::update("EXEC [sp_updateChecklist] $id_gestionChecklist,'$nameArea','$namefamily','$nameoperation','$nameItem','$namerules','$nameChecklist'");
            $GestionChecklist = DB::select('SELECT * FROM GestionChecklist');
            return response()->json(['status'=>true,'message'=>'Se modificó correctamente.','data'=>$GestionChecklist], 200);  
      
        
            }
           
        }
        //funcion para eliminar los checklist con la funcion EXEC llamamos al procedimiento //

    public function  checklistdelete(Request $request){
        if (!$request->input('id_gestionChecklist')){
            // NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['code'=>422,'message'=>'Debes mandar el id correcto.'])],422);
        } else{
            $id_gestionChecklist = $request->input('id_gestionChecklist');
            DB::delete("EXEC [sp_deleteChecklist] $id_gestionChecklist");
            $GestionChecklist = DB::select('SELECT * FROM GestionChecklist');
                
        }
        return response()->json(['status'=>'Se eliminó correctamente.','data'=>$GestionChecklist],204);

    }
     //funcion para editar el estado con la funcion EXEC llamamos al procedimiento //
     public function estadoUpdate(Request $request){
            
        if (!$request->input('id_gestionChecklist')){
            // NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['status'=> false,'message'
            =>'Ingresa el id correcto.'])]);		
        } else{
            
            $id_gestionChecklist = $request->input('id_gestionChecklist');
            $estado = $request->input('estado');

            DB::update("EXEC [sp_estadoUpdate] '$id_gestionChecklist','$estado'");
            $GestionChecklist = DB::select('SELECT * FROM GestionChecklist');
                                        
        
            }
            return response()->json(['status'=>true,'message'=>'Se modificó correctamente.','data'=>$GestionChecklist], 200);  

        }

}

