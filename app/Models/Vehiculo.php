<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        "placa",
        "marca",
        "clase",
        "modelo",
        "procedencia",
        "servicio",
        "traccion",
        "turbo",
        "carroceria",
        "tipo",
        "subtipo",
        "cilindrada",
        "nro_puertas",
        "capacidad_carga",
        "capacidad_plaza",
        "capacidad_arrastre",
        "foto",
        "observacion",
        "fecha_registro",
    ];

    protected $appends = ['full_name', 'path_image', "fecha_registro_t"];
    public function getFechaRegistroTAttribute()
    {
        return date("d/m/Y", strtotime($this->fecha_registro));
    }

    public function getPathImageAttribute()
    {
        if ($this->foto && trim($this->foto) != "") {
            return asset('imgs/vehiculos/' . $this->foto);
        }
        return asset('imgs/vehiculos/default.png');
    }

    public function getFullNameAttribute()
    {
        return $this->placa . ' | ' . $this->marca . ($this->clase ? " | " . $this->clase : "") . " | " . $this->modelo;
    }
}
