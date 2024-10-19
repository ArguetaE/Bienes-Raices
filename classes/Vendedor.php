<?php

namespace App;

class Vendedor extends ActiveRecord {

    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($argc = [])
    {
        $this->id = $argc['id'] ?? NULL;
        $this->nombre = $argc['nombre'] ?? '';
        $this->apellido = $argc['apellido'] ?? '';
        $this->telefono = $argc['telefono'] ?? '';
    }   

    public function validar(){
        
        if(!$this->nombre) {
            self::$errores[] = "El Nombre es Obligatorio";
        }
        if(!$this->apellido) {
            self::$errores[] = "El Apellido es Obligatorio";
        }

        if(!$this->telefono) {
            self::$errores[] = "El Telefono es Obligatorio";
        }
        if (!preg_match('/[0-9]{8}/', $this->telefono)) { /* Expresion Regular */
            self::$errores[] = "Formato no valido";
        }
        return self::$errores;
    }
}