<?php
namespace App\Clases;

class Herramientas
{
    public function obtener_sistema_modulos($cadena){
        $cadenaFinal = '';
		$cadena = substr($cadena, strpos($cadena, '_')+1, strlen($cadena));
        $cadenaFinal = substr($cadena, 0, strpos($cadena, '_'));

		return $cadenaFinal;
    }

    public function obtener_modulo_modulos($cadena){
        $cadenaFinal = '';
		$cadena = substr($cadena, strpos($cadena, '_')+1, strlen($cadena));
        $cadenaFinal = substr($cadena, 0, strpos($cadena, '_'));

		return $cadenaFinal;
    }

    public function buscar_elemento_objeto($elemento, $filtro ,$objeto){
        foreach ($objeto as $o) {
            switch ($filtro) {
                case 'presentacion':
                    if($elemento == $o->idSistema){
                        return $o->idSistema;
                    }
                    break;
            }
        }

        return false;
    }
}

?>