<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadSolicitante extends Model
{
    use HasFactory;

    protected $fillable = [
        "nro",
        "codigo",
        "unidad_id",
        "descripcion_viaje",
        "fecha_solicitud",
        "nro_hoja_ruta",
        "conductor",
        "vehiculo",
        "combustible",
        "observacion",
        "fecha_registro",
    ];

    protected $appends = ["fecha_registro_t", "fecha_solicitud_t", "full_name", "conductor_txt", "vehiculo_txt", "combustible_txt"];

    public function getConductorTxtAttribute()
    {
        return $this->conductor == 1 ? "SI" : "NO";
    }
    public function getVehiculoTxtAttribute()
    {
        return $this->vehiculo == 1 ? "SI" : "NO";
    }

    public function getCombustibleTxtAttribute()
    {
        return $this->combustible == 1 ? "SI" : "NO";
    }

    public function getFullNameAttribute()
    {
        return $this->codigo . ' | ' . $this->unidad->nombre;
    }

    public function getFechaSolicitudTAttribute()
    {
        return date("d/m/Y", strtotime($this->fecha_solicitud));
    }

    public function getFechaRegistroTAttribute()
    {
        return date("d/m/Y", strtotime($this->fecha_registro));
    }

    public static function getNewNro()
    {
        $nro = 1;
        $ultimo = UnidadSolicitante::orderBy("nro", "asc")->get()->last();
        if ($ultimo) {
            $nro = $ultimo->nro;
            $nro = (int)$nro + 1;
        }
        return $nro;
    }

    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'unidad_id');
    }

    public function solicitud_combustibles()
    {
        return $this->hasMany(SolicitudCombustible::class, 'unidad_solicitante_id');
    }
}
