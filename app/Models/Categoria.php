<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias'; // Nombre de la tabla en la BD
    protected $primaryKey = 'cat_id'; // Clave primaria 
    public $incrementing = true; // incremental
    protected $fillable = ['cat_nom', 'estatus'];

    /**
     * Relación con las subcategorías.
     */
    public function subcategorias()
    {
        return $this->hasMany(Subcategoria::class, 'cat_id');
    }

    /**
     * Relación con los tickets.
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'cat_id');
    }
}
