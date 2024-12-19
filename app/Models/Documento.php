<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    // Nombre de la tabla con el esquema especificado
    protected $table = 'tikets.td_documento';

    protected $primaryKey = 'doc_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'tick_id',
        'doc_nom',
        'fech_crea',
        'est',
    ];

    // Relación con el modelo Ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'tick_id', 'tick_id');
    }
}


