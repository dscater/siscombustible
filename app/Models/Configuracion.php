<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Configuracion extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre_sistema",
        "alias",
        "razon_social",
        "ciudad",
        "dir",
        "fono",
        "web",
        "actividad",
        "correo",
        "logo",
    ];

    protected $appends = ['path_image', "img64"];

    public function getImg64Attribute()
    {
        if ($this->logo) {
            $ruta = public_path("imgs/" . $this->logo);
            if (file_exists($ruta)) {
                $contenidoImagen = file_get_contents($ruta);
                $base64 = base64_encode($contenidoImagen);
                $formato = File::extension($ruta);
                return "data:image/" . $formato . ";base64, " . $base64;
            }
        }
        return "";
    }

    public function getPathImageAttribute()
    {
        return asset('imgs/' . $this->logo);
    }
}
