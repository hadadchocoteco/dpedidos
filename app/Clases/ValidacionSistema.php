<?php
namespace APP\Clases;
use Illuminate\Support\Facades\DB;

class ValidacionSistema{
    /* Función que agrega o actualiza información que la API envía */
    public function guardar_empresa($datos = array()){
        $existe = DB::table('empresas')->where('rfc',$datos['rfc'])->first();

        if($existe != ''){
            $idEmpresa = $existe->idEmpresa;

            DB::table('empresas')
                ->where('rfc',$datos['rfc'])
                ->update([
                    'descripcion' => $datos['nombreComercial'],
                    'razonSocial' => $datos['razonSocial'],
                    'fechaRegistro' => $datos['fechaRegistro'],
                    'estado' => 1
                ]);
        }else{
            $idEmpresa = DB::table('empresas')
                ->insertGetId([
                    'rfc' => $datos['rfc'],
                    'descripcion' => $datos['nombreComercial'],
                    'razonSocial' => $datos['razonSocial'],
                    'fechaRegistro' => $datos['fechaRegistro'],
                    'estado' => 1
                ]);
        }

        return $idEmpresa;
    }

    public function guardar_usuarios($datos = array()){
        $existe = DB::table('usuarios')->where('correo',$datos['usuario'])->first();

        if($existe != ''){
            DB::table('usuarios')
                ->where('correo',$datos['usuario'])
                ->update([
                    'puesto' => 'admin',
                    'correo' => $datos['usuario'],
                    'contrasena' => $datos['contrasena'],
                    'nombre' => $datos['usuario'],
                    'estado' => 'activo',
                    'fechaRegistro' => $datos['fechaAlta']
                ]);
        }else{
            DB::table('usuarios')
            ->insert([
                'idEmpresa' => $datos['idEmpresa'],
                'correo' => $datos['usuario'],
                'puesto' => 'admin',
                'contrasena' => $datos['contrasena'],
                'nombre' => $datos['usuario'],
                'estado' => 'activo',
                'fechaRegistro' => $datos['fechaAlta']
            ]);
        }
    }

    public function guardar_modulos_empresa($idEmpresa, $datos = array()){
        /* Consultamos usuarios con módulos */
        $usuarios = DB::table('modulos_usuario')
            ->select('idUsuario','idEmpresa')
            ->where('idEmpresa',$idEmpresa)
            ->groupBy('idUsuario','idEmpresa')
            ->get();
        /* Recorremos los usuarios */
        /* Obtenemos estado de los módulos que el usuario tiene */
        /* Se mantendrá el estado original del módulo */
        foreach ($usuarios as $u) {
            $modulos_usuario = DB::table('modulos_usuario')
                ->select('*')
                ->join('modulos','modulos.idModulo','=','modulos_usuario.idModulo')
                ->where('idUsuario',$u->idUsuario)
                ->where('idEmpresa',$idEmpresa)
                ->get();

            foreach ($modulos_usuario as $mu) {
                foreach($datos as $rm){
                    if($mu->abreviacion == $rm['abreviacion']){
                        if($mu->estado != 'inactivo'){
                            DB::table('modulos_usuario')
                                ->where('idEmpresa',$idEmpresa)
                                ->where('idModulo',$mu->idModulo)
                                ->where('idUsuario',$u->idUsuario)
                                ->update(['estado' => 'activo']);
                        }
                    }
                }
            }
        }
    }

    public function actualizar_modulos_sistema($datos = array()){
        DB::table('modulos')->truncate();

        DB::table('modulos')->insert($datos);
    }
}
?>