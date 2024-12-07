<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    use HasFactory;

    protected $table = 'subcategorias'; // Nombre de la tabla en la BD
    protected $primaryKey = 'subcat_id'; // Clave primaria personalizada
    public $incrementing = true; // Indica que es incremental
    protected $fillable = ['subcat_nom', 'cat_id', 'estatus'];

    /**
     * Relación con la categoría.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'cat_id', 'cat_id');
    }
}
