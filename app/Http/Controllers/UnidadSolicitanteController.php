<?php

namespace App\Http\Controllers;

use App\Models\HistorialAccion;
use App\Models\UnidadSolicitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UnidadSolicitanteController extends Controller
{
    public $validacion = [
        'unidad_id' => 'required',
        'descripcion_viaje' => 'required|min:3',
        'fecha_solicitud' => 'required|date',
    ];

    public $mensajes = [
        'unidad_id.required' => 'Este campo es obligatorio',
        'descripcion_viaje.required' => 'Este campo es obligatorio',
        'descripcion_viaje.min' => 'Debes ingresar al menos :min caracteres',
        'fecha_solicitud.required' => 'Este campo es obligatorio',
        'fecha_solicitud.date' => 'Debes ingresar una fecha valida',
    ];

    public function index(Request $request)
    {
        $unidad_solicitantes = [];
        if (Auth::user()->tipo == 'CONDUCTOR') {
            $unidad_solicitantes = UnidadSolicitante::select("unidad_solicitantes.*")
                ->with(["unidad"])
                ->join("solicitud_combustibles", "solicitud_combustibles.unidad_solicitante_id", "=", "unidad_solicitantes.id")
                ->where("solicitud_combustibles.user_id", Auth::user()->id)
                ->orderBy("id", "desc")->get();
        } else {
            $unidad_solicitantes = UnidadSolicitante::with(["unidad"])->orderBy("id", "desc")->get();
        }
        return response()->JSON(['unidad_solicitantes' => $unidad_solicitantes, 'total' => count($unidad_solicitantes)], 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $request["nro"] = UnidadSolicitante::getNewNro();
        $request["codigo"] = "SOL." . $request["nro"];
        $request['fecha_registro'] = date('Y-m-d');
        DB::beginTransaction();
        try {
            // crear el UnidadSolicitante
            $nueva_unidad_solicitante = UnidadSolicitante::create(array_map('mb_strtoupper', $request->all()));

            $datos_original = HistorialAccion::getDetalleRegistro($nueva_unidad_solicitante, "unidad_solicitantes");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'CREACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->unidad_solicitante . ' REGISTRO UNA UNIDAD SOLICITANTE',
                'datos_original' => $datos_original,
                'modulo' => 'UNIDAD SOLICITANTE',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            DB::commit();
            return response()->JSON([
                'sw' => true,
                'unidad_solicitante' => $nueva_unidad_solicitante,
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

    public function update(Request $request, UnidadSolicitante $unidad_solicitante)
    {
        $request->validate($this->validacion, $this->mensajes);
        DB::beginTransaction();
        try {
            $datos_original = HistorialAccion::getDetalleRegistro($unidad_solicitante, "unidad_solicitantes");
            $unidad_solicitante->update(array_map('mb_strtoupper', $request->all()));
            $datos_nuevo = HistorialAccion::getDetalleRegistro($unidad_solicitante, "unidad_solicitantes");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'MODIFICACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->unidad_solicitante . ' MODIFICÓ UNA UNIDAD SOLICITANTE',
                'datos_original' => $datos_original,
                'datos_nuevo' => $datos_nuevo,
                'modulo' => 'UNIDAD SOLICITANTE',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            DB::commit();
            return response()->JSON([
                'sw' => true,
                'unidad_solicitante' => $unidad_solicitante,
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

    public function show(UnidadSolicitante $unidad_solicitante)
    {
        return response()->JSON([
            'sw' => true,
            'unidad_solicitante' => $unidad_solicitante->load(["unidad", "solicitud_combustibles.user", "solicitud_combustibles.vehiculo"])
        ], 200);
    }
    public function destroy(UnidadSolicitante $unidad_solicitante)
    {
        DB::beginTransaction();
        try {
            $datos_original = HistorialAccion::getDetalleRegistro($unidad_solicitante, "unidad_solicitantes");
            $unidad_solicitante->delete();
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'ELIMINACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->unidad_solicitante . ' ELIMINÓ UNA UNIDAD SOLICITANTE',
                'datos_original' => $datos_original,
                'modulo' => 'UNIDAD SOLICITANTE',
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
