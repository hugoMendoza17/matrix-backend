<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ConsultaUsersController extends Controller
{
    //
    public function ConsultaUsuario(){
        $query=DB::table('dbo.Users')
        ->get();
        return view('ConsultaUsuario',['listado'=>$query]);

    }
}
