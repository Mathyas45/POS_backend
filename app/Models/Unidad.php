<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;

    protected $table = 'unidades'; // Especifica el nombre de la tabla

    protected $fillable = [
        'nombre',
        'estado'
    ];

    // Relación uno a muchos inversa
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
