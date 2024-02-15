<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Content-Type: application/json");

    class Conectar {
        protected $dbh;

        protected function Conexion() {
            try {
                $conectar = 
                $this->dbh = 
                new PDO(
                    "mysql:local=localhost;dbname=richardfvg_webservice","root",""
                );

                return $conectar;
            }

            catch (Exception $e) {
                print "¡Error BD!: " . $e->getMessage() . "<br/>";

                die();
            }
        }

        public function set_names() {
            return $this->dbh->query("SET NAMES 'utf8'");
        }
    }
?>