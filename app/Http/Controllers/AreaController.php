<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
Use App\Areas;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\json_decode;


class AreaController extends Controller
{
    //Función para traer el procedimiento de los datos de la tabla áreas
    public function areas() {

        return DB::select('EXECUTE areasGet');
    }
    //Función para ver los usuarios que han registrado áreas en el sistema y mostrarlo en el crud.
    public function areaSelect() {

        return DB::select('EXECUTE areasSelect');
    }
  
    // Función para insertar datos de areas 
    public function areaInsert(Request $request){  
		if (!$request->input('nameArea')  || !$request->input('usuarios')
        || !$request->input('description')
        ){
			// NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(
                [ 
                    'status'=>false,
                    'message'=> 'Formulario vacio.'
                ],);
		}else {
            // Insertamos los datos recibidos en la tabla.
            $nameArea = $request->input('nameArea');
            $description = $request->input('description');
            $usuarios = $request->input('usuarios');
            DB::update("EXEC [sp_insertAreas] '$nameArea','$usuarios', '$description'");
            $areas = DB::select('SELECT * FROM areas');
            return response()->json(
                    [ 
                        'status'=> true,
                        'message'=> 'Se registro correctamente.',
                        'data'=> $areas
                    ],
                     201
                );
		// Devolvemos la respuesta Http 201 (Created) + los datos del nuevo fabricante + una cabecera de Location + cabecera JSON
        }
    }

    //funcion para modficar datos de areas //
    public function areaUpdate(Request $request){
        
		if (!$request->input('id_areas')){
			// NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['status'=> false,'message'
            =>'Debes ingresar el id correcto.'])]);		
        } else{
        
            $id_areas = $request->input('id_areas');
            $nameArea = $request->input('nameArea');
            $usuarios = $request->input('usuarios');
            $description = $request->input('description');

         //se manda a llamar el procedimiento con exec y nombre del procedimiento  
            DB::update("EXEC [sp_updateAreas] $id_areas,'$nameArea','$usuarios','$description'");
            $areas = DB::select('SELECT * FROM areas');
            return response()->json(['status'=>true,'message'=>'Se modificó correctamente.','data'=>$areas], 200);  
            
        }
    }

    public function areadelete(Request $request){
        if (!$request->input('id_areas')){
			// NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['status'=> false,'message'
            =>'Ingresa el id correcto.'])]);
        } else{
        
            $id_areas = $request->input('id_areas');
            DB::delete("EXEC [sp_deleteAreas] $id_areas");
            $areas = DB::select('SELECT * FROM areas');
            return response()->json(['status'=>true,'message'=>'Se elimino correctamente.','data'=>$areas], 200);  
            
        }
    }

}
