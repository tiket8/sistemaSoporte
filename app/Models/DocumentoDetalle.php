<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoDetalle extends Model
{
    use HasFactory;

    protected $table = 'td_documento_detalle'; // Nombre de la tabla
    protected $primaryKey = 'det_id'; // Clave primaria
    public $incrementing = false; // Si no es incremental, cambiar a false
    protected $keyType = 'int'; // Tipo de clave primaria

    protected $fillable = [
        'det_id',
        'tickd_id',
        'det_nom',
        'est',
    ];

    public $timestamps = false; // Desactivar timestamps automáticos

    // Relación con Documento
    public function documento()
    {
        return $this->belongsTo(Documento::class, 'tickd_id', 'doc_id');
    }
}
