<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
Use App\warrantyRules;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\json_decode;

class warrantyRulesController extends Controller
{
    //Consulta de todas las reglas de garantía registradas
    public function warrantyRules() {

        return DB::select('EXECUTE warrantyRulesget');
    }
    //consulta los items registrados
    public function warrantyRuleSelect() {

        return DB::select('EXECUTE warrantyRuleSelect');
    }
   

    // Función para insertar datos de las reglas de garantia con la funcion EXEC llamamos al procedimiento//
    public function warrantyRuleInsert(Request $request){  
		if (!$request->input('namerules')  || !$request->input('nameItem') || !$request->input('namegrades') 
      /*  || !$request->input('imagen_nombre') */|| !$request->input('typeAnswer')|| !$request->input('description')  || !$request->input('respuesta') ){
			// NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(
                [ 
                    'status'=>false,
                    'message'=> 'Faltan datos.',
                    'data'=>$warrantyRules

                ],);
		}else {
            // Insertamos los datos recibidos en la tabla.
            $namerules = $request->input('namerules');
            $nameItem = $request->input('nameItem');
            $namegrades = $request->input('namegrades');
            $imagen_nombre = $request->input('imagen_nombre');
            $typeAnswer = $request->input('typeAnswer');
            $description = $request->input('description');
            $respuesta = $request->input('respuesta');
            $validarImagen = (1) /*|| $validarImagen=(0)*/;

            
            DB::update("EXEC [sp_insertwarrantyRules] '$namerules', '$nameItem' , '$namegrades', '$imagen_nombre','$typeAnswer','$description', '$respuesta', '$validarImagen'");
            $warrantyRules = DB::select('SELECT * FROM warrantyRules');
            return response()->json(
                    [ 
                        'status'=>true,
                        'message'=> 'Se registro correctamente.',
                        'data'=> $warrantyRules
                    ],
                     201
                );
		// Devolvemos la respuesta Http 201 (Created) + los datos del nuevo fabricante + una cabecera de Location + cabecera JSON
        }
    }

    //funcion para editar los datos de reglas de garantia con la funcion EXEC llamamos al procedimiento //
    public function warrantyRulesUpdate(Request $request){
        
		if (!$request->input('id_rule')){
			// NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['status'=> false,'message'
            =>'Ingresa el id correcto.'])]);		
        } else{
        
            $id_rule = $request->input('id_rule');
            $namerules = $request->input('namerules');
            $nameItem = $request->input('nameItem');
            $namegrades = $request->input('namegrades');
            $imagen_nombre = $request->input('imagen_nombre');
            $typeAnswer = $request->input('typeAnswer');
            $description = $request->input('description');
            $respuesta = $request->input('respuesta');
            $validarImagen = (1) /*|| $validarImagen=(0)*/;


            DB::update("EXEC [sp_updatewarrantyRules] '$id_rule','$namerules','$nameItem','$namegrades','$imagen_nombre','$typeAnswer','$description','$respuesta','$validarImagen'");
            $warrantyRules = DB::select('SELECT * FROM warrantyRules');
                                    
     
        }
        return response()->json(['status'=>true,'message'=>'Se modificó correctamente.','data'=>$warrantyRules], 200);  

    }
    //funcion para eliminar los datos de reglas de garantia con la funcion EXEC llamamos al procedimiento //

    public function warrantyRulesdelete(Request $request){
        if (!$request->input('id_rule')){
			// NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['code'=>422,'message'=>'Debes mandar el id correcto.'])],422);
		} else{
            $id_rule = $request->input('id_rule');
            DB::delete("EXEC [sp_deletewarrantyRules] $id_rule");
            $warrantyRules = DB::select('SELECT * FROM warrantyRules');
            
        }
        return response()->json(['status'=>'Se eliminó correctamente.','data'=>$warrantyRules],204);

    }
    /*
    public function warrantyRulesChecksUpdate(Request $request){

        if (!$request->input('arrayIdRules')){
			// NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['code'=>422,'message'=>'ERROR.'])],422);
		} else{
            
            $arrayIdRules = json_decode($request->input('arrayIdRules'));
            
            foreach($arrayIdRules as $obj){
                $id_rule = $obj->{'id_rule'};
                $estado = $obj->{'estado'};
                DB::update("EXEC [sp_checksUpdate] '$id_rule' ,'$estado'");
            }

            return response()->json(['status'=>'ESTADO CAMBIO.','data'=>$arrayIdRules],200);
            
        }
    }*/

   
}
