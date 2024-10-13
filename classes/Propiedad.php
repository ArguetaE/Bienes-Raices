<?php

namespace App;

class Propiedad {

    /* Base de Datos */
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];

    // Errores
    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    /* Definir la conxeion a la BD */
    public static function setDB($database){
        self::$db = $database;
    }

    public function __construct($argc = [])
    {
        $this->id = $argc['id'] ?? '';
        $this->titulo = $argc['titulo'] ?? '';
        $this->precio = $argc['precio'] ?? '';
        $this->imagen = $argc['imagen'] ?? '';
        $this->descripcion = $argc['descripcion'] ?? '';
        $this->habitaciones = $argc['habitaciones'] ?? '';
        $this->wc = $argc['wc'] ?? '';
        $this->estacionamiento = $argc['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $argc['vendedores_id'] ?? '';
    }

    public function guardar (){

        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $query = " INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
        
        $resultado = self::$db->query($query);

        return $resultado;
    }

    // Identificar y unir los datos de la BD
    public function atributos(){
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if($columna === 'id')continue;
            $atributos[$columna] = $this->$columna;   
        }
        return $atributos;
    }

    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Subida de archivos
    public function setImagen($imagen){

    // Asignar al atriburo imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    // Validacion
    public static function getErrores(){
        return self::$errores;
    }

    public function validar (){
        
        if(!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }

        if(!$this->precio) {
            self::$errores[] = 'El Precio es Obligatorio';
        }

        if( strlen($this->descripcion ) < 50 ) {
            self::$errores[] = 'La descripción es obligatoria y debe tener al menos 50 caracteres';
        }

        if(!$this->habitaciones) {
            self::$errores[] = 'El Número de habitaciones es obligatorio';
        }
        
        if(!$this->wc) {
            self::$errores[] = 'El Número de Baños es obligatorio';
        }

        if(!$this->estacionamiento) {
            self::$errores[] = 'El Número de lugares de Estacionamiento es obligatorio';
        }
        
        if(!$this->vendedores_id) {
            self::$errores[] = 'Elige un vendedor';
        }
        if(!$this->imagen ) {
            self::$errores[] = 'La Imagen es Obligatoria';
        }
        return self::$errores;
    }
    // Lista todas las propiedades
    public static function all(){
        $query = 'SELECT * FROM propiedades';

        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function consultarSQL($query){
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = []; 
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new self;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

}