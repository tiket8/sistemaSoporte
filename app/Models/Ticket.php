<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tm_ticket';

    protected $fillable = [
        'usu_id',
        'cat_id',
        'cats_id',
        'tick_titulo',
        'tick_descrip',
        'tick_estado',
        'fech_crea',
        'usu_asig',
        'fech_asig',
        'prio_id',
        'est',
    ];

    public $timestamps = false;

    // Relación con usuarios
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usu_id');
    }

    // Relación con categorías
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'cat_id');
    }

    // Relación con subcategorías
    public function subcategoria()
    {
        return $this->belongsTo(SubCategoria::class, 'cats_id');
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'tick_id');
    }
}

