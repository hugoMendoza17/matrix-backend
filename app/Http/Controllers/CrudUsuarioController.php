<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\RegistroUsuarioRequest;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Models\UsuarioModel;
use function GuzzleHttp\json_decode;




class CrudUsuarioController extends Controller
{
    //
    
    public function users() {

        return DB::select('EXECUTE usersGet');
    }
  
    // Función para insertar datos de areas 
    public function userInsert(Request $request){  
		if (!$request->input('usuarios') || !$request->input('password') || !$request->input('typeUser')
        || !$request->input('nombre') || !$request->input('apellido')){
			// NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(
                [ 
                    'status'=>false,
                    'message'=> 'Formulario vacio.'
                ],);
		}else {
            // Insertamos los datos recibidos en la tabla.
            $usuarios = $request->input('usuarios');
            $password = $request->input('password');
            $nombre= $request->input('nombre');
            $apellido= $request->input('apellido');
            $typeUser = $request->input('typeUser');
           
            DB::update("EXEC [sp_insertUser] '$usuarios', '$password',  '$nombre', '$apellido','$typeUser'");
            $users = DB::select('SELECT * FROM Users');
            return response()->json(
                    [ 
                        'status'=> true,
                        'message'=> 'Se registro correctamente.',
                        'data'=> $users
                    ],
                     201
                );
		// Devolvemos la respuesta Http 201 (Created) + los datos del nuevo fabricante + una cabecera de Location + cabecera JSON
        }
    }

    //funcion para modificar datos de usuarios //
    public function userUpdate(Request $request){
        
		if (!$request->input('id_user')){
			// NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['status'=>false,'message'=>'Manda el id correcto.','data'=>$users], 200);  

		}else {
            $id_user= $request->input('id_user');
            $usuarios = $request->input('usuarios');
            $password = $request->input('password');
            $nombre = $request ->input('nombre');
            $apellido = $request ->input('apellido');
            $typeUser = $request->input('typeUser');

           /* if(empty($request->input('nombreArea')) || empty($request->input('description'))){
                return response()->json(['status'=>false,'msg'=>'Datos inválidos.'], 422);  
            }else{*/
            
            DB::update("EXEC [sp_updateUser] $id_user,'$usuarios','$password','$nombre','$apellido','$typeUser'");
            $users = DB::select('SELECT * FROM Users');

            return response()->json(['status'=>true,'message'=>'Se modificó correctamente.','data'=>$users], 200);  
            
        }
    }

    public function userDelete(Request $request){
        if (!$request->input('id_user')){
			// NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['status'=> false,'message'=>'Debes mandar el id del usuario.'])],422);
		} else{
            $id_user = $request->input('id_user');
            DB::delete("EXEC [sp_deleteUsers] $id_user");
            $users = DB::select('SELECT * FROM Users');
            return response()->json(['status'=>true,'message'=>'Se modificó elimino correctamente.','data'=>$users], 200);  
            
        }
    }

}
