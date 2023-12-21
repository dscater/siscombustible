<?php

namespace App\Http\Controllers;

use App\Models\HistorialAccion;
use App\Models\SolicitudCombustible;
use App\Models\UnidadSolicitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SolicitudCombustibleController extends Controller
{
    public $validacion = [
        'unidad_solicitante_id' => 'required',
        'fecha_entrega' => 'required|date',
    ];

    public $mensajes = [
        'unidad_solicitante_id.required' => 'Este campo es obligatorio',
        'fecha_entrega.required' => 'Este campo es obligatorio',
        'fecha_entrega.date' => 'Debes ingresar una fecha valida',
        'user_id.required' => 'Este campo es obligatorio',
        'vehiculo_id.required' => 'Este campo es obligatorio',
        'combustible.required' => 'Este campo es obligatorio',
    ];

    public function index(Request $request)
    {
        $solicitud_combustibles = [];
        if (Auth::user()->tipo == 'CONDUCTOR') {
            $solicitud_combustibles = SolicitudCombustible::with(["unidad_solicitante", "user", "vehiculo"])->where("user_id", Auth::user()->id)->orderBy("id", "desc")->get();
        } else {
            $solicitud_combustibles = SolicitudCombustible::with(["unidad_solicitante", "user", "vehiculo"])->orderBy("id", "desc")->get();
        }
        return response()->JSON(['solicitud_combustibles' => $solicitud_combustibles, 'total' => count($solicitud_combustibles)], 200);
    }

    public function store(Request $request)
    {
        $unidad_solicitante = UnidadSolicitante::find($request->unidad_solicitante_id);
        if (!$unidad_solicitante) {
            return response()->JSON([
                "message" => "No se encontró la unidad de solicitud que seleccionó"
            ], 500);
        }
        if ($unidad_solicitante->conductor == 1) {
            $this->validacion["user_id"] = "required";
        }
        if ($unidad_solicitante->vehiculo == 1) {
            $this->validacion["vehiculo_id"] = "required";
        }
        if ($unidad_solicitante->combustible == 1) {
            $this->validacion["combustible"] = "required";
        }

        $request->validate($this->validacion, $this->mensajes);
        $request['fecha_registro'] = date('Y-m-d');
        DB::beginTransaction();
        try {
            // obtener unidad_solicitante

            // crear el SolicitudCombustible
            $nueva_solicitud_combustible = SolicitudCombustible::create(array_map('mb_strtoupper', $request->all()));
            if ($unidad_solicitante->conductor == 0) {
                $nueva_solicitud_combustible->user_id = NULL;
            }
            if ($unidad_solicitante->vehiculo == 0) {
                $nueva_solicitud_combustible->vehiculo_id = NULL;
            }
            if ($unidad_solicitante->combustible == 0) {
                $nueva_solicitud_combustible->combustible = NULL;
            }
            $nueva_solicitud_combustible->save();


            $datos_original = HistorialAccion::getDetalleRegistro($nueva_solicitud_combustible, "solicitud_combustibles");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'CREACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->solicitud_combustible . ' REGISTRO UNA SOLICITUD DE COMBUSTIBLE',
                'datos_original' => $datos_original,
                'modulo' => 'SOLICITUD DE COMBUSTIBLE',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            DB::commit();
            return response()->JSON([
                'sw' => true,
                'solicitud_combustible' => $nueva_solicitud_combustible,
                'msj' => 'El registro se realizó de forma correcta',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->JSON([
                'sw' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, SolicitudCombustible $solicitud_combustible)
    {
        $unidad_solicitante = UnidadSolicitante::find($request->unidad_solicitante_id);
        if (!$unidad_solicitante) {
            return response()->JSON([
                "message" => "No se encontró la unidad de solicitud que seleccionó"
            ], 500);
        }
        if ($unidad_solicitante->conductor == 1) {
            $this->validacion["user_id"] = "required";
        }
        if ($unidad_solicitante->vehiculo == 1) {
            $this->validacion["vehiculo_id"] = "required";
        }
        if ($unidad_solicitante->combustible == 1) {
            $this->validacion["combustible"] = "required";
        }
        $request->validate($this->validacion, $this->mensajes);
        DB::beginTransaction();
        try {
            $datos_original = HistorialAccion::getDetalleRegistro($solicitud_combustible, "solicitud_combustibles");
            $solicitud_combustible->update(array_map('mb_strtoupper', $request->all()));
            if ($unidad_solicitante->conductor == 0) {
                $solicitud_combustible->user_id = NULL;
            }
            if ($unidad_solicitante->vehiculo == 0) {
                $solicitud_combustible->vehiculo_id = NULL;
            }
            if ($unidad_solicitante->combustible == 0) {
                $solicitud_combustible->combustible = NULL;
            }
            $solicitud_combustible->save();
            $datos_nuevo = HistorialAccion::getDetalleRegistro($solicitud_combustible, "solicitud_combustibles");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'MODIFICACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->solicitud_combustible . ' MODIFICÓ UNA SOLICITUD DE COMBUSTIBLE',
                'datos_original' => $datos_original,
                'datos_nuevo' => $datos_nuevo,
                'modulo' => 'SOLICITUD DE COMBUSTIBLE',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            DB::commit();
            return response()->JSON([
                'sw' => true,
                'solicitud_combustible' => $solicitud_combustible,
                'msj' => 'El registro se actualizó de forma correcta'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->JSON([
                'sw' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(SolicitudCombustible $solicitud_combustible)
    {
        return response()->JSON([
            'sw' => true,
            'solicitud_combustible' => $solicitud_combustible
        ], 200);
    }
    public function destroy(SolicitudCombustible $solicitud_combustible)
    {
        DB::beginTransaction();
        try {
            $datos_original = HistorialAccion::getDetalleRegistro($solicitud_combustible, "solicitud_combustibles");
            $solicitud_combustible->delete();
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'ELIMINACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->solicitud_combustible . ' ELIMINÓ UNA SOLICITUD DE COMBUSTIBLE',
                'datos_original' => $datos_original,
                'modulo' => 'SOLICITUD DE COMBUSTIBLE',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            DB::commit();
            return response()->JSON([
                'sw' => true,
                'msj' => 'El registro se eliminó correctamente'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->JSON([
                'sw' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
