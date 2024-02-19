<?php
    /**
     * Este script establece los encabezados necesarios para aceptar solicitudes CORS de cualquier origen,
     * define los métodos HTTP permitidos, y especifica que el tipo de contenido de la respuesta será JSON.
     * Incluye la definición de la clase Conectar, diseñada para manejar la conexión a la base de datos.
     */

    // 1. Establece los headers para permitir solicitudes CORS desde cualquier origen
    header("Access-Control-Allow-Origin: *");
    // 2. Establece los métodos HTTP permitidos para las solicitudes
    header("Access-Control-Allow-Methods: GET, POST");
    // 3. Define el tipo de contenido esperado en la respuesta como JSON
    header("Content-Type: application/json");

    // 4. Define la clase Conectar para manejar la conexión a la base de datos
    /**
     * Clase para manejar la conexión a la base de datos.
     * 
     * Esta clase contiene los métodos necesarios para establecer y manejar una conexión a la base de datos
     * utilizando PDO, incluyendo la configuración de la codificación de caracteres a UTF-8.
     */
    class Conectar {
        // 5. Declara una variable protegida para almacenar el manejador de la base de datos
        /**
         * Variable protegida para almacenar el manejador de la base de datos.
         * 
         * @var PDO
         */        
        protected $dbh;

        // 6. Define el método Conexion para establecer la conexión a la base de datos
        /**
         * Establece la conexión a la base de datos utilizando PDO.
         * Configura el manejador de la base de datos para usar la codificación UTF-8.
         * 
         * @return PDO Objeto de conexión a la base de datos.
         * @throws PDOException Si ocurre un error al intentar conectar con la base de datos.
         */
        protected function Conexion() {
            try {
                // 7. Intenta realizar la conexión utilizando PDO y almacena el manejador de la base de datos
                $conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=richardfvg_webservice","root","");

                // 8. Retorna el objeto de conexión
                return $conectar;
            }
            // 9. Captura cualquier excepción durante el intento de conexión
            catch (Exception $e) {
                // 10. Imprime el mensaje de error y termina la ejecución
                print "¡Error BD!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        // 11. Define el método set_names para establecer la codificación de caracteres a UTF-8 en la conexión a la base de datos
        /**
         * Establece la codificación de caracteres a UTF-8 en la conexión a la base de datos.
         * 
         * Ejecuta una consulta SQL para asegurar que las comunicaciones con la base de datos usen UTF-8.
         * 
         * @return bool True si la operación es exitosa, False en caso contrario.
         */
        public function set_names() {
            // 12. Ejecuta la consulta SQL para establecer la codificación y retorna el resultado
            return $this->dbh->query("SET NAMES 'utf8'");
        }
    }
?>
