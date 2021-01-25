<?php
namespace App\Clases;

class Herramientas
{
    public function buscar_elemento_objeto($elemento, $filtro ,$objeto){
        foreach ($objeto as $o) {
            switch ($filtro) {
                case 'idModulo':
                    if($elemento == $o->idModulo){
                        return $o->idModulo;
                    }
                    break;
            }
        }

        return false;
    }
}

?>