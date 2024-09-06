<?php

    namespace App;

    class Propiedad {

        // Base de datos
        protected static $db;
        protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorID'];

        // Errores o validación
        protected static $errores = [];

        // Definir la conexion a la base de datos
        public static function setDB($database) {
            self::$db = $database;
        }

        public $id;
        public $titulo;
        public $precio;
        public $imagen;
        public $descripcion;
        public $habitaciones;
        public $wc;
        public $estacionamiento;
        public $creado;
        public $vendedorID;

        public function __construct($args = []) {
            $this->id = $args['id'] ?? '';
            $this->titulo = $args['titulo'] ?? '';
            $this->precio = $args['precio'] ?? '';
            $this->imagen = $args['imagen'] ?? 'imagen.jpg';
            $this->descripcion = $args['descripcion'] ?? '';
            $this->habitaciones = $args['habitaciones'] ?? '';
            $this->wc = $args['wc'] ?? '';
            $this->estacionamiento = $args['estacionamiento'] ?? '';
            $this->creado = date('Y/m/d');
            $this->vendedorID = $args['vendedorid'] ?? '';
        }

        public function guardar() {

            // Sanitizar los datos con POO
            $atributos = $this->sanitizar();

            // Recorre las llaves y se inserta en una cadena en la tabla

            $query = "INSERT INTO propiedades (" . join(', ', array_keys($atributos)) . ") VALUES (' ". join("', '", array_values($atributos)) . " ')";

            $resultado = self::$db->query($query);

            debugear($resultado);
        }

        public function atributos() {
            $atributos = [];

            foreach (self::$columnasDB as $columna) {
                if($columna === 'id') continue;
                $atributos[$columna] = $this->$columna;
            }

            return $atributos;
        }

        public function sanitizar() {
            $atributos = $this->atributos();
            // Arreglo donde se guardan los valores sanitizados
            $sanitizado = [];

            foreach($atributos as $key => $value) {
                // Cada valor sera sanitizado con la funcion escape_string
                $sanitizado[$key] = self::$db->escape_string($value); 
            }

            return $sanitizado;
        }

        // Validación
        public static function getErrores() {
            return self::$errores;
        }

        public function validar() {
            // Validaciones
            if (!$this->titulo)
                self::$errores[] = "Debes añadir un título";

            if (!$this->precio)
                self::$errores[] = "Debes añadir un precio";

            if (!$this->imagen['name'])
                self::$errores[] = "Debes añadir una imagen";

            if (strlen($this->descripcion) < 50)
                self::$errores[] = "La descripción es demasiado corta";

            if (!$this->habitaciones)
                self::$errores[] = "Debes añadir el número de habitaciones";

            if (!$this->wc)
                self::$errores[] = "Debes añadir el número de baños";
            
            if (!$this->estacionamiento)
                self::$errores[] = "Debes añadir el número de estacionamientos";

            if (!$this->vendedorID)
                self::$errores[] = "Debes añadir un vendedor";

            // Validar tamaño a 1MB
            $medida = 1000 * 1000;
            if ($this->imagen['size'] > $medida)
                self::$errores[] = "La imagen es muy pesada";

            return self::$errores;
        }
    }