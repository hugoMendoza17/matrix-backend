<?php
namespace App\Http\Controllers;
Use App\item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\json_decode;

class itemController extends Controller
{
    //
    public function item() {

        return DB::select('EXECUTE itemGet');
    }
    public function itemSelect() {

        return DB::select('EXECUTE itemSelect');
    }
   

    // Función para insertar datos de items// 
    public function itemInsert(Request $request){  
		if (!$request->input('nameItem') || !$request->input('nameoperation') 
        || !$request->input('description')){
			// NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['status'=> false,'message'
            =>'Faltan datos necesarios para procesar el registros correctamente.'])]);
		}else {
            // Insertamos los datos recibidos en la tabla.
            $nameItem = $request->input('nameItem');
            $nameoperation = $request->input('nameoperation');
            $description = $request->input('description');

            DB::update("EXEC [sp_insertItem] '$nameItem', '$nameoperation', '$description'");
            // con la funcion EXEC [sp_insertItem] se manda a llamar al procedimiento.//
            $item = DB::select('SELECT * FROM item');
            return response()->json(
                    [ 
                        'status'=> true,
                        'message'=> 'Se registro correctamente.',
                        'data'=> $item
                    ],
                     201
                );
		// Devolvemos la respuesta Http 201 (Created) + los datos del nuevo fabricante + una cabecera de Location + cabecera JSON
        }
    }

    //funcion para modficar datos de items //
    public function itemUpdate(Request $request){
        
		if (!$request->input('id_item')){
			// NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['status'=> false,'message'
            =>'Debes mandar el id correcto.', 'data'=>$item])]);
        } else{
        
            $id_item = $request->input('id_item');
            $nameItem = $request->input('nameItem');
            $nameoperation = $request->input('nameoperation');
            $description = $request->input('description');
            
            DB::update("EXEC [sp_updateItem] $id_item,'$nameItem', '$nameoperation','$description'");
            $item = DB::select('SELECT * FROM item');
            

            return response()->json(['status'=>true,'message'=>'Se modificó correctamente.','data'=>$item]);  
            
        }
    }

    // Función para eliminar el id de los items  con la funcion EXEC llamamos al procedimiento//
    public function itemdelete(Request $request){
        if (!$request->input('id_item')){
        // NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['status'=>true,'message'=>'Debes mandar el id del área.'])],422);
        }else{
            $idItem = $request->input('id_item');
            DB::delete("EXEC [sp_deleteItem] $idItem");
            $item = DB::select('SELECT * FROM item');
            return response()->json(['status'=>true,'message'=>'Se eliminó correctamente.','data'=>$item], 200);  
                
        }
    }
}
