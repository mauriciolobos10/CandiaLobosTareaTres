<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perro extends Model
{
    use HasFactory;

    protected $primaryKey= 'id';
    protected $table = 'perros';
    public $timestamps= true;

    protected $fillable= [
        "nombre",
        "url_foto",
        "descripcion"
    ];
}
