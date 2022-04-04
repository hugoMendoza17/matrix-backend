<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioModel extends Model
{
    use HasFactory;
    protected $table = 'Users';
    protected $primaryKey = 'id_user';
    public $timestamps = false;
    protected $fillable = [
        'id_user',
        'name' ,
        'password',
        'tipoUsuario',
    ];


}
