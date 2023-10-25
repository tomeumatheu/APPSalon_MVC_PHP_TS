<?php

namespace Controllers;

use Model\Cita;
use Model\CitasServicio;
use Model\Servicio;

#[\AllowDynamicProperties]
class APIController {
    public static function index(){
        $servicios = Servicio::all();//no requiere instanciar porque all() es static
        echo json_encode($servicios);//convertir un arreeglo en un objeto

    }

    public static function guardar() {
        //Almacena la Cita y devuelve el ID
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        $id = $resultado['id'];
        
        //Alamcena los Servicios con el ID de la Cita
        $idServicios = explode(",", $_POST['servicios']);
        foreach($idServicios as $idServicio){
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitasServicio($args);
            $citaServicio -> guardar();
        }
        //Retornamos una respuesta
        $respuesta = [
            'resultado' => $resultado
        ];
        echo json_encode($respuesta);
    }

    public static function eliminar() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }

}