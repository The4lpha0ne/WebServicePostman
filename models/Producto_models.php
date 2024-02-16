<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    header("Content-Type: application/json");

    // 1. Incluye el archivo de configuración de conexión a la base de datos
    require_once("../config/conexion.php");

    // 2. Define la clase Producto que extiende de Conectar
    class Producto extends Conectar {
        // 3. Define el método para insertar un producto
        public function insert_producto($cat_id, $prod_nom, $prod_desc, $prod_precio) {
            // 4. Establece la conexión con la base de datos
            $conectar = parent::conexion();
            // 5. Establece el conjunto de caracteres a UTF-8
            parent::set_names();
            // 6. Prepara la consulta SQL para insertar un producto
            $sql = "INSERT INTO tm_producto (cat_id, prod_nom, prod_desc, prod_precio, est) VALUES (?, ?, ?, ?, 1)";
            $sql = $conectar->prepare($sql);
            // 7. Vincula los valores a la consulta SQL
            $sql->bindValue(1, $cat_id);
            $sql->bindValue(2, $prod_nom);
            $sql->bindValue(3, $prod_desc);
            $sql->bindValue(4, $prod_precio);
            // 8. Ejecuta la consulta y retorna verdadero o falso dependiendo del éxito
            if ($sql->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // 9. Define el método para obtener todos los productos
        public function get_productos() {
            // 10. Establece la conexión con la base de datos
            $conectar = parent::conexion();
            // 11. Establece el conjunto de caracteres a UTF-8
            parent::set_names();
            // 12. Prepara la consulta SQL para obtener todos los productos activos
            $sql = "SELECT * FROM tm_producto WHERE est = 1";
            $sql = $conectar->prepare($sql);
            // 13. Ejecuta la consulta
            $sql->execute();
            // 14. Retorna los resultados como un array asociativo
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        // 15. Define el método para obtener un producto por su ID
        public function get_producto_x_id($prod_id) {
            // 16. Establece la conexión con la base de datos
            $conectar = parent::conexion();
            // 17. Establece el conjunto de caracteres a UTF-8
            parent::set_names();
            // 18. Prepara la consulta SQL para obtener un producto por su ID
            $sql = "SELECT * FROM tm_producto WHERE prod_id = ? AND est = 1";
            $sql = $conectar->prepare($sql);
            // 19. Vincula el ID del producto a la consulta SQL
            $sql->bindValue(1, $prod_id);
            // 20. Ejecuta la consulta
            $sql->execute();
            // 21. Retorna el resultado como un array asociativo
            return $resultado = $sql->fetch(PDO::FETCH_ASSOC);
        }

        // 22. Define el método para actualizar un producto
        public function update_producto($prod_id, $cat_id, $prod_nom, $prod_desc, $prod_precio) {
            // 23. Establece la conexión con la base de datos
            $conectar = parent::conexion();
            // 24. Establece el conjunto de caracteres a UTF-8
            parent::set_names();
            // 25. Prepara la consulta SQL para actualizar un producto
            $sql = "UPDATE tm_producto SET cat_id = ?, prod_nom = ?, prod_desc = ?, prod_precio = ? WHERE prod_id = ?";
            $sql = $conectar->prepare($sql);
            // 26. Vincula los nuevos valores a la consulta SQL
            $sql->bindValue(1, $cat_id);
            $sql->bindValue(2, $prod_nom);
            $sql->bindValue(3, $prod_desc);
            $sql->bindValue(4,$prod_precio);
            // 27. Vincula el ID del producto a actualizar.
            $sql->bindValue(5, $prod_id);
            // 28. Ejecuta la consulta y verifica si fue exitosa.
            if ($sql->execute()) {
                return true; // Indica una operación exitosa.
            } else {
                return false; // Indica un fallo en la operación.
            }
        }

        // 29. Define el método para eliminar un producto.
        public function delete_producto($prod_id) {
            // 30. Establece la conexión con la base de datos.
            $conectar = parent::conexion();
            // 31. Establece el conjunto de caracteres a UTF-8.
            parent::set_names();
            // 32. Prepara la consulta SQL para eliminar un producto por su ID.
            $sql = "DELETE FROM tm_producto WHERE prod_id = ?";
            $sql = $conectar->prepare($sql);
            // 33. Vincula el ID del producto a eliminar.
            $sql->bindValue(1, $prod_id);
            // 34. Ejecuta la consulta y verifica si fue exitosa.
            if ($sql->execute()) {
                return true; // Indica una operación exitosa.
            } else {
                return false; // Indica un fallo en la operación.
            }
        }                
    }
?>
