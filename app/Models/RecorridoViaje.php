<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecorridoViaje extends Model
{
    use HasFactory;

    protected $fillable = [
        "unidad_solicitante_id",
        "descripcion_recorrido",
        "fecha_inicio",
        "fecha_fin",
        "inicio_combustible",
        "fin_combustible",
        "restante_combustible",
        "inicio_kilometraje",
        "fin_kilometraje",
        "observacion",
        "fecha_registro",
    ];

    protected $appends = ["fecha_registro_t", "fecha_inicio_t", "fecha_fin_t"];

    public function getFechaRegistroTAttribute()
    {
        return date("d/m/Y", strtotime($this->fecha_registro));
    }
    public function getFechaInicioTAttribute()
    {
        return date("d/m/Y", strtotime($this->fecha_registro));
    }
    public function getFechaFinTAttribute()
    {
        return date("d/m/Y", strtotime($this->fecha_registro));
    }
    public function unidad_solicitante()
    {
        return $this->belongsTo(UnidadSolicitante::class, 'unidad_solicitante_id');
    }
}
