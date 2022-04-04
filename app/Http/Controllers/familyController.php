<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
Use App\Family;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\json_decode;

class familyController extends Controller
{
    // Función para consultar datos de familia 
    public function familys() {

        return DB::select('EXECUTE familyGet');
    }
    public function familySelect() {

        return DB::select('EXECUTE familySelect');
    }
   

    // Función para insertar datos de familia//
    //con el metodo EXEC o EXECUTE Mandamos a llamar a nuestro procedimiento de sql//
    
    // Función para insertar datos de areas 
    public function familyInsert(Request $request){  
		if (!$request->input('namefamily') || !$request->input('nameArea') 
        || !$request->input('description')
         ){
			// NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['status'=> false,'message'
            =>'Faltan datos necesarios para procesar el registro correctamente.'])]);
		}else {
            // Insertamos los datos recibidos en la tabla.
            $namefamily = $request->input('namefamily');
            $nameArea = $request->input('nameArea');
            $description = $request->input('description');
            DB::update("EXEC [sp_insertfamily] '$namefamily','$nameArea', '$description'");
            $familys = DB::select('SELECT * FROM family');
            return response()->json(
                    [ 
                        'status'=> true,
                        'message'=> 'Se registro correctamente.',
                        'data'=> $familys
                    ],
                     201
                );
		// Devolvemos la respuesta Http 201 (Created) + los datos del nuevo fabricante + una cabecera de Location + cabecera JSON
        }
    }

    //funcion para modificar datos de familia //
    public function familyUpdate(Request $request){
        
		if (!$request->input('id_family')){
			// NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['status'=> false,'message'
            =>'Enviar el id correcto.'])]);		
        } else{
        
            $idfamily = $request->input('id_family');
            $namefamily = $request->input('namefamily');
            $nameArea= $request->input('nameArea');
            $description = $request->input('description');

           /* if(empty($request->input('nombreArea')) || empty($request->input('description'))){
                return response()->json(['status'=>false,'msg'=>'Datos inválidos.'], 422);  
            }else{*/
            
            DB::update("EXEC [sp_updatefamily] $idfamily,'$namefamily','$nameArea','$description' ");
            $family = DB::select('SELECT * FROM family');
            
            
            

            return response()->json(['status'=>true,'message'=>'Se modificó correctamente.','data'=>$family], 200);  
            
        }
    }
    //funcion para eliminar el id de familia //
    public function familydelete(Request $request){
        if (!$request->input('id_family')){
			// NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['status'=> false,'message'=>'Debes mandar el id de family.'])],422);
		} else{
        
            $idfamily = $request->input('id_family');
           /* if(empty($request->input('nombreArea')) || empty($request->input('description'))){
                return response()->json(['status'=>false,'msg'=>'Datos inválidos.'], 422);  
            }else{*/
            
            DB::delete("EXEC [sp_deletefamily] $idfamily");
            $family = DB::select('SELECT * FROM family');
            
            
            

            return response()->json(['status'=>true,'message'=>'Se elimino correctamente.','data'=>$family], 200);  
            
        }

    }
}
