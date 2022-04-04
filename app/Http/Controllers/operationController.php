<?php

namespace App\Http\Controllers;
Use App\operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\json_decode;

class operationController extends Controller
{
    //
    public function operation() {

        return DB::select('EXECUTE operationGet');
    }
    public function operationSelect() {

        return DB::select('EXECUTE operationSelect');
    }
   

    // Función para insertar datos de operación // 
    public function operationInsert(Request $request){  
		if (!$request->input('nameoperation') || !$request->input('namefamily') 
        || !$request->input('description') ){
			// NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['status'=> false,'message'
            =>'Faltan datos necesarios para procesar el registro correctamente.'])]);
		}else {
            // Insertamos los datos recibidos en la tabla.
            $nameoperation = $request->input('nameoperation');
            $namefamily = $request -> input ('namefamily');
            $description = $request->input('description');
            DB::update("EXEC [sp_insertOperation] '$nameoperation','$namefamily','$description'");
            $operation = DB::select('SELECT * FROM operation');
            return response()->json(
                    [ 
                        'status'=> true,
                        'message'=> 'Se registro correctamente.',
                        'data'=> $operation
                    ],
                     201
                );
		// Devolvemos la respuesta Http 201 (Created) + los datos del nuevo fabricante + una cabecera de Location + cabecera JSON
        }
    }

    //función para modificar datos de operación //
    public function operationUpdate(Request $request){
        
		if (!$request->input('id_operation')){
			// NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['status'=> false,'message'
            =>'Debes ingresar el id correcto.'])]);		
        } else{
        
            $idoperation = $request->input('id_operation');
            $nameoperation = $request->input('nameoperation');
            $namefamily = $request ->input ('namefamily');
            $description = $request->input('description');

           /* if(empty($request->input('nombreArea')) || empty($request->input('description'))){
                return response()->json(['status'=>false,'msg'=>'Datos inválidos.'], 422);  
            }else{*/
            
            DB::update("EXEC [sp_updateOperation] $idoperation,'$nameoperation','$namefamily','$description'");
            $operation = DB::select('SELECT * FROM operation');
            

            return response()->json(['status'=>true,'message'=>'Se modificó correctamente.','data'=>$operation], 200);  
            
        }
    }
    //función para eliminar id de una operación //
    public function operationDelete(Request $request){
        if (!$request->input('id_operation')){
			// NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['code'=>422,'message'=>'Debes mandar el id correcto.'])],422);
		} else{
        
            $idoperation = $request->input('id_operation');
           /* if(empty($request->input('nombreArea')) || empty($request->input('description'))){
                return response()->json(['status'=>false,'msg'=>'Datos inválidos.'], 422);  
            }else{*/
            
            DB::delete("EXEC [sp_deleteOperation] $idoperation");
            $operation = DB::select('SELECT * FROM operation');
    
            return response()->json(['status'=>true,'message'=>'Se elimino correctamente el id.','data'=>$operation], 200);  
            
        }
    }
}
