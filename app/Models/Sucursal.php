<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
    protected $table = 'sucursales'; // Especifica el nombre de la tabla

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'email',
        'ruc',
    ];
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

}
