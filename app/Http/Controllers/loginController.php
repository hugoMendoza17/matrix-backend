<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\UsuarioModel;
class loginController extends Controller
{
    //función de login
    public function login(Request $request){
        //No acepta campos vacios
        $usuarios = $request->input('usuarios');
        $password = $request->input('password');
        //consulta en la base de datos si existe un usuario con los datos que se insertaron
        $usuariosExists =  DB::table('Users')->where('usuarios', $usuarios)->exists();
        $passwordExists =  DB::table('Users')->where('password', $password)->exists();

// si el usuario existe entonces le da acceso al sistema
        if($usuariosExists && $passwordExists){
    
            $session=DB::select("SELECT * FROM Users WHERE usuarios='$usuarios' AND password='$password'");
            return response()->json(['status'=>true,'message'=>'Usuario correcto.','session'=>$session], 200);  
            //si el usuario no existe le manda mensaje de usuario incorrecto
        }else{
            return response()->json(['status'=>false,'message'=>'Usuario incorrecto.','session'=>$session], 200);              
        }
    
    }

}
