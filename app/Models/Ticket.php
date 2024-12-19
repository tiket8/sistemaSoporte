<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $primaryKey = 'tick_id'; 
    public $incrementing = true; 
    protected $keyType = 'int'; 


    protected $fillable = [
        'usu_id', 'cat_id', 'cats_id', 'tick_titulo', 
        'tick_descrip', 'prio_id', 'tick_estado'
    ];
    
    //asigna estado de abierto a los tickets nuevos
    protected $attributes = [
        'tick_estado' => 'abierto',
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usu_id', 'id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'cat_id', 'cat_id');
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class, 'cats_id', 'subcat_id');
    }

    public function prioridad()
    {
        return $this->belongsTo(Prioridad::class, 'prio_id', 'prio_id');
    }

    public function documentos()
    {
    return $this->hasMany(Documento::class, 'tick_id', 'tick_id');
    }

}
