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

        public $propiedadID;
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
            $this->propiedadID = $args['id'] ?? '';
            $this->titulo = $args['titulo'] ?? '';
            $this->precio = $args['precio'] ?? '';
            $this->imagen = $args['imagen'] ?? '';
            $this->descripcion = $args['descripcion'] ?? '';
            $this->habitaciones = $args['habitaciones'] ?? '';
            $this->wc = $args['wc'] ?? '';
            $this->estacionamiento = $args['estacionamiento'] ?? '';
            $this->creado = date('Y/m/d');
            $this->vendedorID = $args['vendedorid'] ?? 1;
        }

        public function guardar() {
            if (isset($this->propiedadID)) {
                // Actualizar
                $this->actualizar();
            } else {
                // Crear nuevo registro
                $this->crear();
            }
        }

        public function crear() {
            // Sanitizar los datos
            $atributos = $this->sanitizar();

            // Recorre las llaves y se inserta en una cadena en la tabla

            $query = "INSERT INTO propiedades (" . join(', ', array_keys($atributos)) . ") VALUES (' ". join("', '", array_values($atributos)) . " ')";

            $resultado = self::$db->query($query);

            if ($resultado) {
                // Redireccionar al usuario a admin
                header ('Location: /bienesraices/admin?resultado=1');
            }
        }

        public function actualizar() {
            // Sanitizar los datos
            $atributos = $this->sanitizar();

            $valores = [];

            foreach ($atributos as $key => $value) {
                $valores[] = "{$key}='{$value}'";
            }

            $query = "UPDATE propiedades SET ";
            $query .= join(', ', $valores);
            $query .= " WHERE propiedadID = '" . self::$db->escape_string($this->propiedadID) . "' ";
            $query .= " LIMIT 1";

            $resultado = self::$db->query($query);

            if ($resultado) {
                // Redireccionar al usuario a admin
                header('Location: /bienesraices/admin?resultado=2');
            }
        }


        public function eliminar() {
            $query = "DELETE FROM propiedades WHERE propiedadID = " . self::$db->escape_string($this->propiedadID) . " LIMIT 1";

            $resultado = self::$db->query($query);

            if ($resultado) {
                $this->borrarImagen();
                header('Location: /bienesraices/admin?resultado=3');
            }
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

        public function setImage($imagen) {
            // Elimina la imagen previa
            if (isset($this->propiedadID)) {
                $this->borrarImagen();
            }
            
            // Asignar imagen
            if($imagen) {
                $this->imagen = $imagen;
            }
        }

        public function borrarImagen() {
            $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);

            if ($existeArchivo) {
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
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

            if (!$this->imagen)
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

            return self::$errores;
        }

        // Listar todas las propiedades
        public static function all() {
            $query = "SELECT * FROM propiedades";

            $resultado = self::consultarSQL($query);

            return $resultado;
        }

        // BUscar una propiedad por su id
        public static function find($id) {
            // Obtener los datos de la propiedad
            $query = "SELECT * FROM propiedades WHERE propiedadID = $id";

            $resultado = self::consultarSQL($query);

            return array_shift($resultado);
        }

        public static function consultarSQL($query) {
            // Consultar la base de datos
            $resultado = self::$db->query($query);

            // Iterar los resultados
            $array = [];

            while($registro = $resultado->fetch_assoc()) {
                $array[] = self::crearObjeto($registro);
            }

            // Liberar la memoria con el metodo free
            $resultado->free();

            // Retornar los resultados
            return $array;
        }

        protected static function crearObjeto($registro) {
            $objeto = new self;  // Crear una nueva instancia de la clase Propiedad
        
            // Asignar los valores del registro al objeto
            foreach ($registro as $key => $value) {
                if (property_exists($objeto, $key)) {
                    $objeto->$key = $value;  // Asignar la propiedad al objeto
                }
            }
        
            return $objeto;  // Retornar el objeto creado
        }
        

        // Sincronizar los objetos en memoria
        public function sincronizar($args = []) {
            foreach ($args as $key => $value) {
                if(property_exists($this, $key) && !is_null($value)) {
                    $this->$key = $value;
                }
            }

            return $args;
        }
    }