<?php
namespace App\Clases;
use Illuminate\Support\Facades\Storage;

class Archivos
{
    public function existe_archivo(){
        $ruta = $_GET['ruta'];
        $archivo = $_GET['archivo'];

        if(Storage::disk()->exists($ruta,$archivo)){
            return 1;
        }else{
            return 0;
        }
    }
}
?>