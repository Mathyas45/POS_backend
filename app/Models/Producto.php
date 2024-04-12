<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'codigo',
        'imagen',
        'descripcion',
        'precio',
        'stock',
        'categoria_id',
        'unidad_id',
        'marca_id',


    ];
    //Relacion uno a muchos inversa
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }
    public function unidad(){
        return $this->belongsTo(Unidad::class);
    }
    public function marca(){
        return $this->belongsTo(Marca::class);
    }
}
