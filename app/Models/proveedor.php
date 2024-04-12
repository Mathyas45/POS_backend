<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proveedor extends Model
{
    use HasFactory;
    protected $table = 'proveedores'; // Especifica el nombre de la tabla

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'email',
        'num_documento',
    ];
}
