<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudCombustible extends Model
{
    use HasFactory;
    protected $fillable = [
        "unidad_solicitante_id",
        "user_id",
        "vehiculo_id",
        "combustible",
        "nro_vale",
        "fecha_entrega",
        "observacion",
        "fecha_registro",
    ];

    protected $appends = ["fecha_registro_t", "fecha_entrega_t"];

    public function getFechaRegistroTAttribute()
    {
        return date("d/m/Y", strtotime($this->fecha_registro));
    }
    public function getFechaEntregaTAttribute()
    {
        return date("d/m/Y", strtotime($this->fecha_entrega));
    }

    public function unidad_solicitante()
    {
        return $this->belongsTo(UnidadSolicitante::class, 'unidad_solicitante_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
    }
}
