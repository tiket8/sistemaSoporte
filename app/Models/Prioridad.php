<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prioridad extends Model
{
    use HasFactory;

    protected $table = 'tm_prioridad';
    protected $primaryKey = 'prio_id'; // Llave primaria de la tabla

    protected $fillable = [
        'prio_nom', 'est' // Campos que se pueden asignar masivamente
    ];
    
    public $timestamps = false;
}
