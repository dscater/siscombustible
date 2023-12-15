<?php

namespace App\Http\Controllers;

use App\Models\AsignacionGrupo;
use App\Models\Comunicado;
use App\Models\Curso;
use App\Models\GestoriaSolicitud;
use App\Models\GestoriaTip;
use App\Models\GrupoProfesor;
use App\Models\GrupoRecurso;
use App\Models\HistorialAccion;
use App\Models\Horario;
use App\Models\Inscripcion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use PDF;

class UserController extends Controller
{
    public $validacion = [
        'nombre' => 'required|min:4',
        'paterno' => 'required|min:4',
        'dir' => 'required',
        'tipo' => 'required',
    ];

    public $mensajes = [
        'nombre.required' => 'Este campo es obligatorio',
        'nombre.min' => 'Debes ingressar al menos 4 carácteres',
        'paterno.required' => 'Este campo es obligatorio',
        'paterno.min' => 'Debes ingresar al menos 4 carácteres',
        'ci.required' => 'Este campo es obligatorio',
        'ci.numeric' => 'Debes ingresar un valor númerico',
        'ci.unique' => 'Este número de C.I. ya fue registrado',
        'ci_exp.required' => 'Este campo es obligatorio',
        'dir.required' => 'Este campo es obligatorio',
        'dir.min' => 'Debes ingresar al menos 4 carácteres',
        'tipo.required' => 'Este campo es obligatorio',
        'correo.required' => 'Este campo es obligatorio',
        'correo.unique' => 'Este correo no esta disponible',
        'password.required' => 'Este campo es obligatorio',
        'password.min' => 'Debes ingresar al menos :min carácteres',
    ];

    public $permisos = [
        'ADMINISTRADOR' => [
            'usuarios.index',
            'usuarios.create',
            'usuarios.edit',
            'usuarios.destroy',

            'configuracion.index',
            'configuracion.edit',

            "reportes.usuarios",
        ],
        "DIRECTOR" => [],
        "ADMINISTRATIVO" => [],
        "ENCARGADO DE COMBUSTIBLE" => [],
        "CONDUCTOR" => [],
    ];


    public function index(Request $request)
    {
        $usuarios = User::whereNotIn("tipo", ["ESTUDIANTE", "PROFESOR"])->where('id', '!=', 1)->get();
        return response()->JSON(['usuarios' => $usuarios, 'total' => count($usuarios)], 200);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('foto')) {
            $this->validacion['foto'] = 'image|mimes:jpeg,jpg,png|max:2048';
        }

        $this->validacion['correo'] = 'required|unique:users,correo';
        $this->validacion['password'] = 'required|min:6';

        $request->validate($this->validacion, $this->mensajes);

        $request['fecha_registro'] = date('Y-m-d');
        DB::beginTransaction();
        try {
            // crear el Usuario
            $request['usuario'] = $request->correo;
            $nuevo_usuario = User::create(array_map('mb_strtoupper', $request->except('foto')));
            $nuevo_usuario->password = Hash::make($nuevo_usuario->password);
            $nuevo_usuario->correo = mb_strtolower($nuevo_usuario->correo);
            $nuevo_usuario->usuario = mb_strtolower($nuevo_usuario->usuario);
            $nuevo_usuario->save();
            $nuevo_usuario->foto = 'default.png';
            if ($request->hasFile('foto')) {
                $file = $request->foto;
                $nom_foto = time() . '_' . $nuevo_usuario->usuario . '.' . $file->getClientOriginalExtension();
                $nuevo_usuario->foto = $nom_foto;
                $file->move(public_path() . '/imgs/users/', $nom_foto);
            }
            $nuevo_usuario->save();

            $datos_original = HistorialAccion::getDetalleRegistro($nuevo_usuario, "users");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'CREACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->usuario . ' REGISTRO UN USUARIO',
                'datos_original' => $datos_original,
                'modulo' => 'USUARIOS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            DB::commit();
            return response()->JSON([
                'sw' => true,
                'usuario' => $nuevo_usuario,
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

    public function update(Request $request, User $usuario)
    {
        if ($request->hasFile('foto')) {
            $this->validacion['foto'] = 'image|mimes:jpeg,jpg,png|max:2048';
        }
        $this->validacion['correo'] = 'required|unique:users,correo,' . $usuario->id;

        if (trim($request->password) != '') {
            $this->validacion['password'] = 'required|min:6';
        } else {
            unset($request["password"]);
        }
        $request->validate($this->validacion, $this->mensajes);
        DB::beginTransaction();
        try {

            $datos_original = HistorialAccion::getDetalleRegistro($usuario, "users");
            $usuario->update(array_map('mb_strtoupper', $request->except('foto')));
            $usuario->correo = $request->correo;
            $usuario->usuario = $request->correo;
            $usuario->save();
            if (trim($request->password) != '') {
                $usuario->password = Hash::make($usuario->password);
            }

            if ($request->hasFile('foto')) {
                $antiguo = $usuario->foto;
                if ($antiguo != 'default.png') {
                    \File::delete(public_path() . '/imgs/users/' . $antiguo);
                }
                $file = $request->foto;
                $nom_foto = time() . '_' . $usuario->usuario . '.' . $file->getClientOriginalExtension();
                $usuario->foto = $nom_foto;
                $file->move(public_path() . '/imgs/users/', $nom_foto);
            }
            $usuario->save();

            $datos_nuevo = HistorialAccion::getDetalleRegistro($usuario, "users");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'MODIFICACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->usuario . ' MODIFICÓ UN USUARIO',
                'datos_original' => $datos_original,
                'datos_nuevo' => $datos_nuevo,
                'modulo' => 'USUARIOS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            DB::commit();
            return response()->JSON([
                'sw' => true,
                'usuario' => $usuario,
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

    public function show(User $usuario)
    {
        return response()->JSON([
            'sw' => true,
            'usuario' => $usuario
        ], 200);
    }

    public function actualizaContrasenia(User $usuario, Request $request)
    {
        $request->validate([
            'password_actual' => ['required', function ($attribute, $value, $fail) use ($usuario, $request) {
                if (!\Hash::check($request->password_actual, $usuario->password)) {
                    return $fail(__('La contraseña no coincide con la actual.'));
                }
            }],
            'password' => 'required|confirmed|min:4',
            'password_confirmation' => 'required|min:4'
        ]);


        DB::beginTransaction();
        try {
            $usuario->password = Hash::make($request->password);
            $usuario->save();
            DB::commit();
            return response()->JSON([
                'sw' => true,
                'msj' => 'La contraseña se actualizó correctamente'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->JSON([
                'sw' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function actualizaFoto(User $usuario, Request $request)
    {
        DB::beginTransaction();
        try {

            if ($request->hasFile('foto')) {
                $antiguo = $usuario->foto;
                if ($antiguo != 'default.png') {
                    \File::delete(public_path() . '/imgs/users/' . $antiguo);
                }
                $file = $request->foto;
                $nom_foto = time() . '_' . $usuario->usuario . '.' . $file->getClientOriginalExtension();
                $usuario->foto = $nom_foto;
                $file->move(public_path() . '/imgs/users/', $nom_foto);
            }
            $usuario->save();
            DB::commit();
            return response()->JSON([
                'sw' => true,
                'usuario' => $usuario,
                'msj' => 'Foto actualizada con éxito'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->JSON([
                'sw' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(User $usuario)
    {
        DB::beginTransaction();
        try {
            $antiguo = $usuario->foto;
            if ($antiguo != 'default.png') {
                \File::delete(public_path() . '/imgs/users/' . $antiguo);
            }
            $datos_original = HistorialAccion::getDetalleRegistro($usuario, "users");
            $usuario->delete();
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'ELIMINACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->usuario . ' ELIMINÓ UN USUARIO',
                'datos_original' => $datos_original,
                'modulo' => 'USUARIOS',
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

    public function getPermisos(User $usuario)
    {
        $tipo = $usuario->tipo;
        return response()->JSON($this->permisos[$tipo]);
    }

    public function getInfoBox()
    {
        $tipo = Auth::user()->tipo;
        $array_infos = [];
        if (in_array('inscripcions.index', $this->permisos[$tipo])) {
            $array_infos[] = [
                'label' => 'Inscripciones',
                'cantidad' => count(Inscripcion::all()),
                'color' => 'bg-dark',
                'icon' => asset("imgs/icon_inscripcion.png"),
                "url" => "inscripcions.index"
            ];
        }

        if (in_array('horarios.index', $this->permisos[$tipo])) {
            $array_infos[] = [
                'label' => 'Horarios',
                'cantidad' => count(Horario::all()),
                'color' => 'bg-dark',
                'icon' => asset("imgs/icon_horarios.png"),
                "url" => "horarios.index"
            ];
        }

        if (in_array('gestoria_solicituds.index', $this->permisos[$tipo])) {
            $array_infos[] = [
                'label' => 'Gestoría Solicitudes',
                'cantidad' => count(GestoriaSolicitud::all()),
                'color' => 'bg-dark',
                'icon' => asset("imgs/icon_solicitud.png"),
                "url" => "gestoria_solicituds.index"
            ];
        }
        if (in_array('gestoria_tips.index', $this->permisos[$tipo])) {
            $array_infos[] = [
                'label' => 'Tips de Visa',
                'cantidad' => count(GestoriaTip::all()),
                'color' => 'bg-dark',
                'icon' => asset("imgs/icon_tips.png"),
                "url" => "gestoria_tips.index"
            ];
        }

        if (in_array('users.index', $this->permisos[$tipo])) {
            if (in_array('usuarios.index', $this->permisos[$tipo])) {
                $array_infos[] = [
                    'label' => 'Usuarios',
                    'cantidad' => count(User::where('id', '!=', 1)->get()),
                    'color' => 'bg-dark',
                    'icon' => asset("imgs/icon_users.png"),
                    "url" => "usuarios.index"
                ];
            }
        }

        if (in_array('cursos.index', $this->permisos[$tipo])) {
            $array_infos[] = [
                'label' => 'Cursos',
                'cantidad' => count(Curso::all()),
                'color' => 'bg-dark',
                'icon' => asset("imgs/icon_recursos.png"),
                "url" => "cursos.index"
            ];
        }

        if (in_array('grupo_recursos.index', $this->permisos[$tipo])) {
            $grupo_recursos = GrupoRecurso::all();
            $user = Auth::user();
            if ($user->tipo == 'PROFESOR') {
                $id_grupos_user = GrupoProfesor::where("user_id", $user->id)->pluck("grupo_id");
                $grupo_recursos = GrupoRecurso::whereIn("grupo_id", $id_grupos_user)->get();
            }
            $array_infos[] = [
                'label' => 'Recursos',
                'cantidad' => count($grupo_recursos),
                'color' => 'bg-dark',
                'icon' => asset("imgs/icon_recursos.png"),
                "url" => "grupo_recursos.index"
            ];
        }

        if (in_array('comunicados.index', $this->permisos[$tipo])) {
            $comunicados = Comunicado::all();
            $user = Auth::user();
            if ($user->tipo == 'PROFESOR') {
                $id_grupos_user = GrupoProfesor::where("user_id", $user->id)->pluck("grupo_id");
                $comunicados = Comunicado::whereIn("grupo_id", $id_grupos_user)->get();
            }

            $array_infos[] = [
                'label' => 'Comunicados',
                'cantidad' => count($comunicados),
                'color' => 'bg-dark',
                'icon' => asset("imgs/icon_recursos.png"),
                "url" => "comunicados.index"
            ];
        }

        if (in_array('estudiante_cursos.index', $this->permisos[$tipo])) {
            $user = Auth::user();
            $inscripcion = Inscripcion::where("user_id", $user->id)->get()->first();
            $asignacion_grupos = AsignacionGrupo::where("inscripcion_id", $inscripcion->id)->get();
            $array_infos[] = [
                'label' => 'Cursos',
                'cantidad' => count($asignacion_grupos),
                'color' => 'bg-dark',
                'icon' => asset("imgs/icon_recursos.png"),
                "url" => "estudiante_cursos.index",
                "col" => "col-md-4 col-sm-4"
            ];
        }

        if (in_array('grupo_recursos.estudiante_recursos', $this->permisos[$tipo])) {
            $user = Auth::user();
            $inscripcion = Inscripcion::where("user_id", $user->id)->get()->first();
            $id_grupos_user = AsignacionGrupo::where("inscripcion_id", $inscripcion->id)->pluck("grupo_id");
            $grupo_recursos = GrupoRecurso::whereIn("grupo_id", $id_grupos_user)->get();
            $array_infos[] = [
                'label' => 'Recursos',
                'cantidad' => count($grupo_recursos),
                'color' => 'bg-dark',
                'icon' => asset("imgs/icon_recursos.png"),
                "url" => "grupo_recursos.estudiante_recursos",
                "col" => "col-md-4 col-sm-4"
            ];
        }

        if (in_array('comunicados.estudiantes', $this->permisos[$tipo])) {
            $user = Auth::user();
            $inscripcion = Inscripcion::where("user_id", $user->id)->get()->first();
            $id_grupos_user = AsignacionGrupo::where("inscripcion_id", $inscripcion->id)->pluck("grupo_id");
            $comunicados = Comunicado::whereIn("grupo_id", $id_grupos_user)->get();
            $array_infos[] = [
                'label' => 'Comunicados',
                'cantidad' => count($comunicados),
                'color' => 'bg-dark',
                'icon' => asset("imgs/icon_recursos.png"),
                "url" => "comunicados.estudiantes",
                "col" => "col-md-4 col-sm-4"
            ];
        }


        return response()->JSON($array_infos);
    }

    public function userActual()
    {
        return response()->JSON(Auth::user());
    }

    public function getUsuario(User $usuario)
    {
        return response()->JSON($usuario);
    }

    public function getUsuarioTipo(Request $request)
    {
        $tipo = $request->tipo;
        $usuarios = [];
        if ($tipo != "todos") {
            if (is_array($tipo)) {
                $usuarios = User::where("id", "!=", 1)->whereIn("tipo", $tipo)->get();
            } else {
                $usuarios = User::where("id", "!=", 1)->where("tipo", $tipo)->get();
            }
        } else {
            $usuarios = User::where("id", "!=", 1)->get();
        }
        return response()->JSON($usuarios);
    }
}
