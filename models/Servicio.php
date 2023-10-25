<?php

namespace Model;

#[\AllowDynamicProperties]
class Servicio extends ActiveRecord{
    //Base de Datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    //registrar los atributos
    public $id;
    public $nombre;
    public $precio;

    public function __construct($args = []) {
       $this->id = $args['id'] ?? null;//arreglo asociativo 
       $this->nombre = $args['nombre'] ?? '';
       $this->precio = $args['precio'] ?? '';
    }

    public function validar()
    {
        if(!$this->nombre){
            self::$alertas['error'][] = 'El Nombre del Servicio es Obligatorio';

        }
        if(!$this->precio){
            self::$alertas['error'][] = 'El Precio del Servicio Obligatorio';

        }
        if(!is_numeric($this->precio)){
            self::$alertas['error'][] = 'El Formato del Precio No es Valido';

        }
        return self::$alertas;
    }
}