<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clases\Rest;
use App\Clases\ValidacionSistema;
use Illuminate\Support\Facades\DB;

class InicioController extends Controller
{
    public function index()
    {
        return view('inicio.login');
    }

    public function autorizar(Request $request)
    {
        $ruta = '';
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        $rest = new Rest();
        $vs = new ValidacionSistema();

        $tipo_usuario = DB::table('usuarios')
            ->where('correo',$usuario)
            ->where('estado','activo')
            ->first();

        if($tipo_usuario != ''){
            if($tipo_usuario->puesto == 'usuario'){
                $resultado = DB::table('usuarios')
                    ->select()
                    ->join('empresas','empresas.idEmpresa','=','usuarios.idEmpresa','INNER')
                    ->where('correo',$usuario)
                    ->first();
                /* Consumimos API */
                $res_empresa = $rest->validar_empresa($resultado->rfc);
                $res_sistema = $rest->validar_sistema($resultado->rfc);

                if($res_empresa['mensaje'] == 'ok' && $res_sistema['mensaje'] == 'ok'){
                    $datos_empresa = array(
                        'rfc' => $res_empresa['empresa']['rfc'],
                        'nombreComercial' => $res_empresa['empresa']['nombreComercial'],
                        'razonSocial' => $res_empresa['empresa']['razonSocial'],
                        'fechaRegistro' => $res_empresa['empresa']['fechaRegistro']
                    );
                    /* Actualizamos datos de la empresa */
                    $idEmpresa = $vs->guardar_empresa($datos_empresa);
                    /* Iniciamos sesión */
                    $usuario_datos = DB::table('usuarios')
                        ->join('empresas', 'empresas.idEmpresa', '=', 'usuarios.idEmpresa')
                        ->where('correo',$usuario)
                        ->where('contrasena',$contrasena)
                        ->first();

                    if($usuario_datos != ''){
                        $request->session()->put('ID_EMPRESA',$usuario_datos->idEmpresa);
                        $request->session()->put('ID_USUARIO',$usuario_datos->idUsuario);
                        $request->session()->put('CORREO',$usuario_datos->correo);
                        $request->session()->put('NOMBRE',$usuario_datos->nombre);
                        $request->session()->put('ESTADO',$usuario_datos->estado);
                        $request->session()->put('FECHA_REGISTRO',$usuario_datos->fechaRegistro);
                        $request->session()->put('PUESTO',$usuario_datos->puesto);
                        $request->session()->put('RFC',$usuario_datos->rfc);
                        $request->session()->put('DESCRIPCION',$usuario_datos->descripcion);

                        $ruta = 'dashboard';
                    }else{
                        $ruta = '?m=credencial';
                    }
                }else{
                    $ruta = '?m=estado_empresa';
                }
            }else{
                /* Consumimos API */
                $res_empresa = $rest->validar_empresa($usuario);
                $res_sistema = $rest->validar_sistema($usuario);

                if($res_empresa['mensaje'] == 'ok' && $res_sistema['mensaje'] == 'ok'){
                    $datos_empresa = array(
                        'rfc' => $res_empresa['empresa']['rfc'],
                        'nombreComercial' => $res_empresa['empresa']['nombreComercial'],
                        'razonSocial' => $res_empresa['empresa']['razonSocial'],
                        'fechaRegistro' => $res_empresa['empresa']['fechaRegistro']
                    );
                    /* Actualizamos datos de la empresa */
                    $idEmpresa = $vs->guardar_empresa($datos_empresa);
                    /* Consumimos API */
                    $res_usuario = $rest->validar_usuario($usuario);

                    if($res_usuario['mensaje'] == 'ok'){
                        $datos_usuario = array(
                            'usuario' => $res_usuario['usuario']['usuario'],
                            'contrasena' => $res_usuario['usuario']['contrasena'],
                            'fechaAlta' => $res_usuario['usuario']['fechaAlta'],
                            'idEmpresa' => $idEmpresa
                        );
                        /* Actualizamos datos de usuario */
                        $vs->guardar_usuarios($datos_usuario);
                    }
                    /* Iniciamos sesión */
                    $usuario_datos = DB::table('usuarios')
                        ->join('empresas', 'empresas.idEmpresa', '=', 'usuarios.idEmpresa')
                        ->where('correo',$usuario)
                        ->where('contrasena',$contrasena)
                        ->first();

                    if($usuario_datos != ''){
                        $request->session()->put('ID_EMPRESA',$usuario_datos->idEmpresa);
                        $request->session()->put('ID_USUARIO',$usuario_datos->idUsuario);
                        $request->session()->put('CORREO',$usuario_datos->correo);
                        $request->session()->put('NOMBRE',$usuario_datos->nombre);
                        $request->session()->put('ESTADO',$usuario_datos->estado);
                        $request->session()->put('FECHA_REGISTRO',$usuario_datos->fechaRegistro);
                        $request->session()->put('PUESTO',$usuario_datos->puesto);
                        $request->session()->put('RFC',$usuario_datos->rfc);
                        $request->session()->put('DESCRIPCION',$usuario_datos->descripcion);

                        $ruta = 'dashboard';
                    }else{
                        $ruta = '?m=credencial';
                    }
                }else{
                    $ruta = '?m=estado_empresa';
                }
            }
        }else{
            $ruta = '?m=credencial';
        }

        return redirect($ruta);
    }

    public function cerrar_sesion()
    {
        session()->flush();
        return redirect('/');
    }
}
