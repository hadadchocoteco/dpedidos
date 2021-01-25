<?php
namespace App\Clases;

use Illuminate\Support\Facades\Http;

class Rest{
    public function validar_usuario($usuario){
        $resultado = HTTP::get('http://crm.solucionesdelmar.mx/api/empresa/usuario?usuario='.$usuario);
        return $resultado->json();
    }

    public function validar_empresa($rfc){
        $resultado = HTTP::get('http://crm.solucionesdelmar.mx/api/empresa/empresa?empresa='.$rfc);
        return $resultado->json();
    }

    public function validar_sistema($rfc){
        $resultado = HTTP::get('http://crm.solucionesdelmar.mx/api/empresa/sistema?empresa='.$rfc.'&sistema=meme');
        return $resultado->json();
    }

    public function validar_modulos($rfc){
        $resultado = HTTP::get('http://crm.solucionesdelmar.mx/api/empresa/modulos?sistema=meme&empresa='.$rfc);
        return $resultado->json();
    }

    public function validar_sistema_modulos(){
        $resultado = HTTP::get('http://crm.solucionesdelmar.mx/api/sistema/modulos?sistema=meme');
        return $resultado->json();
    }

    public function actualizar_contrasena($usuario,$contrasena){
        $resultado = HTTP::get('http://crm.solucionesdelmar.mx/api/empresa/usuario/contrasena?usuario='.$usuario.'&contrasena='.$contrasena);
        return $resultado->json();
    }
}
?>