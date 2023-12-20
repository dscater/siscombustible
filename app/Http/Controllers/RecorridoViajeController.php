<?php

namespace App\Http\Controllers;

use App\Models\HistorialAccion;
use App\Models\RecorridoViaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecorridoViajeController extends Controller
{
    public $validacion = [
        'unidad_solicitante_id' => 'required',
        "descripcion_recorrido" => "required",
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date',
        "inicio_combustible" => "required",
        "fin_combustible" => "required",
        "restante_combustible" => "required",
    ];

    public $mensajes = [
        'unidad_solicitante_id.required' => 'Este campo es obligatorio',
        'descripcion_recorrido.required' => 'Este campo es obligatorio',
        'fecha_inicio.required' => 'Este campo es obligatorio',
        'fecha_inicio.date' => 'Debes ingresar una fecha valida',
        'fecha_fin.required' => 'Este campo es obligatorio',
        'fecha_fin.date' => 'Debes ingresar una fecha valida',
        'inicio_combustible.required' => 'Este campo es obligatorio',
        'fin_combustible.required' => 'Este campo es obligatorio',
        'restante_combustible.required' => 'Este campo es obligatorio',
    ];

    public function index(Request $request)
    {
        $recorrido_viajes = RecorridoViaje::with(["unidad_solicitante"])->orderBy("id", "desc")->get();
        return response()->JSON(['recorrido_viajes' => $recorrido_viajes, 'total' => count($recorrido_viajes)], 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $request['fecha_registro'] = date('Y-m-d');
        DB::beginTransaction();
        try {
            // crear el RecorridoViaje
            $nueva_recorrido_viaje = RecorridoViaje::create(array_map('mb_strtoupper', $request->all()));

            $datos_original = HistorialAccion::getDetalleRegistro($nueva_recorrido_viaje, "recorrido_viajes");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'CREACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->recorrido_viaje . ' REGISTRO UN RECORRIDO DE VIAJE',
                'datos_original' => $datos_original,
                'modulo' => 'RECORRIDO DE VIAJES',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            DB::commit();
            return response()->JSON([
                'sw' => true,
                'recorrido_viaje' => $nueva_recorrido_viaje,
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

    public function update(Request $request, RecorridoViaje $recorrido_viaje)
    {
        $request->validate($this->validacion, $this->mensajes);
        DB::beginTransaction();
        try {
            $datos_original = HistorialAccion::getDetalleRegistro($recorrido_viaje, "recorrido_viajes");
            $recorrido_viaje->update(array_map('mb_strtoupper', $request->all()));
            $datos_nuevo = HistorialAccion::getDetalleRegistro($recorrido_viaje, "recorrido_viajes");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'MODIFICACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->recorrido_viaje . ' MODIFICÓ UN RECORRIDO DE VIAJE',
                'datos_original' => $datos_original,
                'datos_nuevo' => $datos_nuevo,
                'modulo' => 'RECORRIDO DE VIAJES',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            DB::commit();
            return response()->JSON([
                'sw' => true,
                'recorrido_viaje' => $recorrido_viaje,
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

    public function show(RecorridoViaje $recorrido_viaje)
    {
        return response()->JSON([
            'sw' => true,
            'recorrido_viaje' => $recorrido_viaje
        ], 200);
    }
    public function destroy(RecorridoViaje $recorrido_viaje)
    {
        DB::beginTransaction();
        try {
            $datos_original = HistorialAccion::getDetalleRegistro($recorrido_viaje, "recorrido_viajes");
            $recorrido_viaje->delete();
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'ELIMINACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->recorrido_viaje . ' ELIMINÓ UN RECORRIDO DE VIAJE',
                'datos_original' => $datos_original,
                'modulo' => 'RECORRIDO DE VIAJES',
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
