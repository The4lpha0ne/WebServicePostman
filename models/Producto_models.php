<?php
    // 1. Establece los encabezados para permitir solicitudes desde cualquier origen
    header("Access-Control-Allow-Origin: *");
    // 2. Permite los métodos GET y POST para las solicitudes
    header("Access-Control-Allow-Methods: GET, POST");
    // 3. Establece los encabezados permitidos en las solicitudes
    header("Content-Type: application/json");

    // 4. Incluye el archivo de configuración de conexión a la base de datos
    require_once("../config/conexion.php");

    // 5. Define la clase Producto que extiende de Conectar
    class Producto extends Conectar {
        // 6. Define el método para insertar un producto
        public function insert_producto($cat_id, $prod_nom, $prod_desc, $prod_precio) {
            // 7. Establece la conexión con la base de datos
            $conectar = parent::conexion();
            // 8. Establece el conjunto de caracteres a UTF-8
            parent::set_names();
            // 9. Prepara la consulta SQL para insertar un producto
            $sql = "INSERT INTO tm_producto (cat_id, prod_nom, prod_desc, prod_precio, est) VALUES (?, ?, ?, ?, 1)";
            $sql = $conectar->prepare($sql);
            // 10. Vincula los valores a la consulta SQL
            $sql->bindValue(1, $cat_id);
            $sql->bindValue(2, $prod_nom);
            $sql->bindValue(3, $prod_desc);
            $sql->bindValue(4, $prod_precio);
            // 11. Ejecuta la consulta y retorna verdadero o falso dependiendo del éxito
            if ($sql->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // 12. Define el método para obtener todos los productos
        public function get_productos() {
            // 13. Establece la conexión con la base de datos
            $conectar = parent::conexion();
            // 14. Establece el conjunto de caracteres a UTF-8
            parent::set_names();
            // 15. Prepara la consulta SQL para obtener todos los productos activos
            $sql = "SELECT * FROM tm_producto WHERE est = 1";
            $sql = $conectar->prepare($sql);
            // 16. Ejecuta la consulta
            $sql->execute();
            // 17. Retorna los resultados como un array asociativo
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        // 18. Define el método para obtener un producto por su ID
        public function get_producto_x_id($prod_id) {
            // 19. Establece la conexión con la base de datos
            $conectar = parent::conexion();
            // 20. Establece el conjunto de caracteres a UTF-8
            parent::set_names();
            // 21. Prepara la consulta SQL para obtener un producto por su ID
            $sql = "SELECT * FROM tm_producto WHERE prod_id = ? AND est = 1";
            $sql = $conectar->prepare($sql);
            // 22. Vincula el ID del producto a la consulta SQL
            $sql->bindValue(1, $prod_id);
            // 23. Ejecuta la consulta
            $sql->execute();
            // 24. Retorna el resultado como un array asociativo
            return $resultado = $sql->fetch(PDO::FETCH_ASSOC);
        }

        // 25. Define el método para actualizar un producto
        public function update_producto($prod_id, $cat_id, $prod_nom, $prod_desc, $prod_precio) {
            // 26. Establece la conexión con la base de datos
            $conectar = parent::conexion();
            // 27. Establece el conjunto de caracteres a UTF-8
            parent::set_names();
            // 28. Prepara la consulta SQL para actualizar un producto
            $sql = "UPDATE tm_producto SET cat_id = ?, prod_nom = ?, prod_desc = ?, prod_precio = ? WHERE prod_id = ?";
            $sql = $conectar->prepare($sql);
            // 29. Vincula los nuevos valores a la consulta SQL
            $sql->bindValue(1, $cat_id);
            $sql->bindValue(2, $prod_nom);
            $sql->bindValue(3, $prod_desc);
            $sql->bindValue(4,$prod_precio);
            // 30. Vincula el ID del producto a actualizar.
            $sql->bindValue(5, $prod_id);
            // 31. Ejecuta la consulta y verifica si fue exitosa.
            if ($sql->execute()) {
                return true; // Retorna verdadero si la actualización fue exitosa.
            } else {
                return false; // Retorna falso si hubo un fallo en la operación.
            }
        }

        // 32. Define el método para eliminar un producto.
        public function delete_producto($prod_id) {
            // 33. Establece la conexión con la base de datos.
            $conectar = parent::conexion();
            // 34. Establece el conjunto de caracteres a UTF-8.
            parent::set_names();
            // 35. Prepara la consulta SQL para eliminar un producto por su ID.
            $sql = "DELETE FROM tm_producto WHERE prod_id = ?";
            $sql = $conectar->prepare($sql);
            // 36. Vincula el ID del producto a eliminar.
            $sql->bindValue(1, $prod_id);
            // 37. Ejecuta la consulta y verifica si fue exitosa.
            if ($sql->execute()) {
                return true; // Retorna verdadero si la eliminación fue exitosa.
            } else {
                return false; // Retorna falso si hubo un fallo en la operación.
            }
        }                
    }
?>
