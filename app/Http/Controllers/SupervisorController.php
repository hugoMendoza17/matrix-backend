<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
Use App\Supervisor;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\json_decode;


class SupervisorController extends Controller
{
    public function Respaldo() {


        return DB::unprepared(DB::raw("BACKUP DATABASE matrix TO DISK ='C:\Backups\matrix.bak'"));
    }
    public function Copia() {


        return DB::unprepared(DB::raw("RESTORE DATABASE matrix TO DISK ='C:\Backups\matrix.bak'"));
    }
    // Función para mandar a llamar el respaldo
    
   

}






