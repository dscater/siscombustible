<?php

namespace App\Http\Controllers;

use App\Models\HistorialAccion;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VehiculoController extends Controller
{
    public $validacion = [
        'placa' => 'required|min:1',
        'marca' => 'required|min:1',
        'modelo' => 'required|min:1',
    ];

    public $mensajes = [
        'placa.required' => 'Este campo es obligatorio',
        'placa.min' => 'Debes ingressar al menos :min carácteres',
        'marca.required' => 'Este campo es obligatorio',
        'marca.min' => 'Debes ingressar al menos :min carácteres',
        'modelo.required' => 'Este campo es obligatorio',
        'modelo.min' => 'Debes ingressar al menos :min carácteres',
    ];

    public function index(Request $request)
    {
        $vehiculos = Vehiculo::whereNotIn("tipo", ["CONDUCTOR"])->where('id', '!=', 1)->get();
        return response()->JSON(['vehiculos' => $vehiculos, 'total' => count($vehiculos)], 200);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('foto')) {
            $this->validacion['foto'] = 'image|mimes:jpeg,jpg,png|max:2048';
        }
        $request->validate($this->validacion, $this->mensajes);
        $request['fecha_registro'] = date('Y-m-d');
        DB::beginTransaction();
        try {
            // crear el Usuario
            $nuevo_vehiculo = Vehiculo::create(array_map('mb_strtoupper', $request->except('foto')));
            $nuevo_vehiculo->save();
            $nuevo_vehiculo->foto = 'default.png';
            if ($request->hasFile('foto')) {
                $file = $request->foto;
                $nom_foto = time() . '_' . $nuevo_vehiculo->vehiculo . '.' . $file->getClientOriginalExtension();
                $nuevo_vehiculo->foto = $nom_foto;
                $file->move(public_path() . '/imgs/vehiculos/', $nom_foto);
            }
            $nuevo_vehiculo->save();

            $datos_original = HistorialAccion::getDetalleRegistro($nuevo_vehiculo, "users");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'CREACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->vehiculo . ' REGISTRO UN VEHICULO',
                'datos_original' => $datos_original,
                'modulo' => 'VEHICULOS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            DB::commit();
            return response()->JSON([
                'sw' => true,
                'vehiculo' => $nuevo_vehiculo,
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

    public function update(Request $request, Vehiculo $vehiculo)
    {
        $this->validacion['ci'] = 'required|min:4|numeric|digits_between:4, 20|unique:users,ci,' . $vehiculo->id;
        if ($request->hasFile('foto')) {
            $this->validacion['foto'] = 'image|mimes:jpeg,jpg,png|max:2048';
        }
        $request->validate($this->validacion, $this->mensajes);
        DB::beginTransaction();
        try {
            $datos_original = HistorialAccion::getDetalleRegistro($vehiculo, "users");
            $vehiculo->update(array_map('mb_strtoupper', $request->except('foto')));
            if ($request->hasFile('foto')) {
                $antiguo = $vehiculo->foto;
                if ($antiguo != 'default.png') {
                    \File::delete(public_path() . '/imgs/vehiculoss/' . $antiguo);
                }
                $file = $request->foto;
                $nom_foto = time() . '_' . $vehiculo->vehiculo . '.' . $file->getClientOriginalExtension();
                $vehiculo->foto = $nom_foto;
                $file->move(public_path() . '/imgs/vehiculos/', $nom_foto);
            }
            $vehiculo->save();

            $datos_nuevo = HistorialAccion::getDetalleRegistro($vehiculo, "users");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'MODIFICACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->vehiculo . ' MODIFICÓ UN VEHICULO',
                'datos_original' => $datos_original,
                'datos_nuevo' => $datos_nuevo,
                'modulo' => 'VEHICULOS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            DB::commit();
            return response()->JSON([
                'sw' => true,
                'vehiculo' => $vehiculo,
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

    public function show(Vehiculo $vehiculo)
    {
        return response()->JSON([
            'sw' => true,
            'vehiculo' => $vehiculo
        ], 200);
    }

    public function destroy(Vehiculo $vehiculo)
    {
        DB::beginTransaction();
        try {
            $antiguo = $vehiculo->foto;
            if ($antiguo != 'default.png') {
                \File::delete(public_path() . '/imgs/vehiculoss/' . $antiguo);
            }
            $datos_original = HistorialAccion::getDetalleRegistro($vehiculo, "users");
            $vehiculo->delete();
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'ELIMINACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->vehiculo . ' ELIMINÓ UN VEHICULO',
                'datos_original' => $datos_original,
                'modulo' => 'VEHICULOS',
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
