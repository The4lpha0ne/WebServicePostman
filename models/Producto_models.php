<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Content-Type: application/json");

    require_once("../config/conexion.php");

    class Producto extends Conectar {
        public function insert_producto($cat_id, $prod_nom, $prod_desc, $prod_precio) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "INSERT INTO tm_producto (cat_id, prod_nom, prod_desc, prod_precio, est) VALUES (?, ?, ?, ?, 1)";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->bindValue(2, $prod_nom);
            $sql->bindValue(3, $prod_desc);
            $sql->bindValue(4, $prod_precio);
            if ($sql->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function get_productos() {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM tm_producto WHERE est = 1";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_producto_x_id($prod_id) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM tm_producto WHERE prod_id = ? AND est = 1";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $prod_id);
            $sql->execute();
            return $resultado = $sql->fetch(PDO::FETCH_ASSOC);
        }

        public function update_producto($prod_id, $cat_id, $prod_nom, $prod_desc, $prod_precio) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "UPDATE tm_producto SET cat_id = ?, prod_nom = ?, prod_desc = ?, prod_precio = ? WHERE prod_id = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->bindValue(2, $prod_nom);
            $sql->bindValue(3, $prod_desc);
            $sql->bindValue(4, $prod_precio);
            $sql->bindValue(5, $prod_id);
            if ($sql->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // public function delete_producto($prod_id) {
        //     $conectar = parent::conexion();
        //     parent::set_names();
        //     $sql = "DELETE FROM tm_producto WHERE prod_id = ?";
        //     $sql = $conectar->prepare($sql);
        //     $sql->bindValue(1, $prod_id);
        //     if ($sql->execute()) {
        //         return true; // Operación exitosa
        //     } else {
        //         return false; // Fallo en la operación
        //     }
        // }

        public function delete_producto($prod_id) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM tm_producto WHERE prod_id = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $prod_id);
            if ($sql->execute()) {
                return true; // Operación exitosa
            } else {
                return false; // Fallo en la operación
            }
        }                
    }
?>
