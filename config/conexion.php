<?php
    // 1. Establece los headers para permitir solicitudes CORS desde cualquier origen
    header("Access-Control-Allow-Origin: *");
    // 2. Establece los métodos HTTP permitidos para las solicitudes
    header("Access-Control-Allow-Methods: GET, POST");
    // 3. Define el tipo de contenido esperado en la respuesta como JSON
    header("Content-Type: application/json");

    // 4. Define la clase Conectar para manejar la conexión a la base de datos
    class Conectar {
        // 5. Declara una variable protegida para almacenar el manejador de la base de datos
        protected $dbh;

        // 6. Define el método Conexion para establecer la conexión a la base de datos
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
        public function set_names() {
            // 12. Ejecuta la consulta SQL para establecer la codificación y retorna el resultado
            return $this->dbh->query("SET NAMES 'utf8'");
        }
    }
?>
