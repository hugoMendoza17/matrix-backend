<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
Use App\InspectAnswer;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\json_decode;


class InspectorController extends Controller
{
  
    // Función para almacenar las respuestas del administrador 
    public function inspectInsert(Request $request){  
		if (!$request->input('respuestaIns')){
			// NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(
                [ 
                    'status'=>false,
                    'message'=> 'Formulario vacio.'
                ],
            );
		}else {
            // Insertamos los datos recibidos en la tabla.
            $respuestaIns = $request->input('respuestaIns');
            $id_gestionChecklist = $request->input('id_gestionChecklist');
            $id_user = $request->input('id_user');
        
            DB::update("EXEC [sp_insertAnswer] '$respuestaIns','$id_gestionChecklist','$id_user'");
            $InspectAnswer = DB::select('SELECT * FROM InspectAnswer');
            return response()->json(
                    [ 
                        'status'=> true,
                        'message'=> 'Se registro la respuesta.',
                        'data'=> $InspectAnswer
                    ],
                     201
                );
		// Devolvemos la respuesta Http 201 (Created) + los datos del nuevo fabricante + una cabecera de Location + cabecera JSON
        }
    }

   

}
