<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class warrantyRules extends Model
{
    use HasFactory;
    protected $fillable = ['namerules', 'description'];
}