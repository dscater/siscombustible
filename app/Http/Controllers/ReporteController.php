<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use App\Models\Curso;
use App\Models\GestoriaSolicitud;
use App\Models\Grupo;
use App\Models\Horario;
use App\Models\Inscripcion;
use App\Models\InscripcionSolicitud;
use App\Models\Profesor;
use App\Models\Unidad;
use App\Models\UnidadSolicitante;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class ReporteController extends Controller
{
    public function usuarios(Request $request)
    {
        $filtro =  $request->filtro;
        $usuarios = User::where('id', '!=', 1)->whereNotIn("tipo", ["ESTUDIANTE", "PROFESOR"])->orderBy("paterno", "ASC")->get();

        if ($filtro == 'Tipo de usuario') {
            $request->validate([
                'tipo' => 'required',
            ]);
            $usuarios = User::where('id', '!=', 1)->where('tipo', $request->tipo)->orderBy("paterno", "ASC")->get();
        }

        $pdf = PDF::loadView('reportes.usuarios', compact('usuarios'))->setPaper('legal', 'landscape');

        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 9, array(0, 0, 0));

        return $pdf->download('Usuarios.pdf');
    }

    public function solicitud_unidad(Request $request)
    {
        $filtro = $request->filtro;
        $unidad_id = $request->unidad_id;
        $solicitud = $request->solicitud;
        $user_id = $request->user_id;
        $vehiculo_id = $request->vehiculo_id;
        $combustible = $request->combustible;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;
        $unidad_solicitantes = [];

        if ($filtro != 'Todos') {
            if ($filtro == 'Unidad') {
                if ($unidad_id != "") {
                    $unidad_solicitantes = UnidadSolicitante::where("unidad_id", $unidad_id)->orderBy("id", "asc")->get();
                }
            }
            if ($filtro == 'Solicitud') {
                if ($solicitud != "Todos") {
                    if ($solicitud == 'Conductor') {
                        if ($user_id != "") {
                            $unidad_solicitantes = UnidadSolicitante::select("unidad_solicitantes.*")
                                ->join("solicitud_combustibles", "solicitud_combustibles.unidad_solicitante_id", "=", "unidad_solicitantes.id")
                                ->where("solicitud_combustibles.user_id", $user_id)
                                ->orderBy("unidad_solicitantes.id", "asc")->distinct()->get();
                        }
                    }
                    if ($solicitud == 'Vehículos') {
                        if ($vehiculo_id != "") {
                            $unidad_solicitantes = UnidadSolicitante::select("unidad_solicitantes.*")
                                ->join("solicitud_combustibles", "solicitud_combustibles.unidad_solicitante_id", "=", "unidad_solicitantes.id")
                                ->where("solicitud_combustibles.vehiculo_id", $vehiculo_id)
                                ->orderBy("unidad_solicitantes.id", "asc")->distinct()->get();
                        }
                    }
                    if ($solicitud == 'Combustible') {
                        if ($combustible != "") {
                            $unidad_solicitantes = UnidadSolicitante::select("unidad_solicitantes.*")
                                ->join("solicitud_combustibles", "solicitud_combustibles.unidad_solicitante_id", "=", "unidad_solicitantes.id")
                                ->where("solicitud_combustibles.combustible", $combustible)
                                ->orderBy("unidad_solicitantes.id", "asc")->distinct()->get();
                        }
                    }
                } else {
                    $unidad_solicitantes = UnidadSolicitante::with(["unidad"])->orderBy("id", "desc")->get();
                }
            }
            if ($filtro == 'Rango de fechas') {
                if ($fecha_ini != "" && $fecha_fin != "") {
                    $unidad_solicitantes = UnidadSolicitante::whereBetween("fecha_registro", [$fecha_ini, $fecha_fin])->orderBy("id", "asc")->get();
                }
            }
        } else {
            $unidad_solicitantes = UnidadSolicitante::with(["unidad"])->orderBy("id", "desc")->get();
        }

        $pdf = PDF::loadView('reportes.solicitud_unidad', compact('unidad_solicitantes'))->setPaper('legal', 'landscape');

        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 9, array(0, 0, 0));

        return $pdf->download('solicitud_unidad.pdf');
    }
    public function cantidad_combustible_unidad(Request $request)
    {
        $filtro = $request->filtro;
        $unidad_id = $request->unidad_id;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;

        $unidads = [];

        $unidads = Unidad::orderBy("nombre", "asc")->get();
        if ($filtro != 'Todos') {
            if ($filtro == 'Unidad') {
                if ($unidad_id != '') {
                    $unidads = Unidad::where("id", $unidad_id)->orderBy("nombre", "asc")->get();
                }
            }
        }

        $pdf = PDF::loadView('reportes.cantidad_combustible_unidad', compact('unidads', 'filtro', 'fecha_ini', 'fecha_fin'))->setPaper('letter', 'portrait');

        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 9, array(0, 0, 0));

        return $pdf->download('cantidad_combustible_unidad.pdf');
    }
    public function cantidad_viajes_conductor(Request $request)
    {
        $filtro = $request->filtro;
        $user_id = $request->user_id;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;

        $usuarios = User::where("tipo", "CONDUCTOR")->where('id', '!=', 1)->get();

        if ($filtro != 'Todos') {
            if ($filtro == 'Conductor') {
                if ($user_id != '') {
                    $usuarios = User::where("tipo", "CONDUCTOR")->where('id', '!=', 1)->where("id", $user_id)->get();
                }
            }
        }

        $pdf = PDF::loadView('reportes.cantidad_viajes_conductor', compact('usuarios', 'filtro', 'fecha_ini', 'fecha_fin'))->setPaper('letter', 'portrait');

        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 9, array(0, 0, 0));

        return $pdf->download('cantidad_viajes_conductor.pdf');
    }
    public function cantidad_combustible_conductor(Request $request)
    {
        $filtro = $request->filtro;
        $user_id = $request->user_id;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;

        $usuarios = User::where("tipo", "CONDUCTOR")->where('id', '!=', 1)->get();
        if ($filtro != 'Todos') {
            if ($filtro == 'Conductor') {
                if ($user_id != '') {
                    $usuarios = User::where("tipo", "CONDUCTOR")->where('id', '!=', 1)->where("id", $user_id)->get();
                }
            }
        }
        $pdf = PDF::loadView('reportes.cantidad_combustible_conductor', compact('usuarios', 'filtro', 'fecha_ini', 'fecha_fin'))->setPaper('letter', 'portrait');

        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 9, array(0, 0, 0));

        return $pdf->download('cantidad_combustible_conductor.pdf');
    }
    public function cantidad_viajes_unidad(Request $request)
    {
        $filtro = $request->filtro;
    }
    public function g_cantidad_combustible_unidad(Request $request)
    {
        $filtro = $request->filtro;
    }
}
