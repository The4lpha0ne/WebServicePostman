<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    header('Content-Type: application/json');

    // 1. Define la clase Categoria que extiende de Conectar para utilizar la conexión a la base de datos.
    Class Categoria extends Conectar {
        // 2. Obtiene todas las categorías activas de la base de datos.
        public function get_categoria() {
            // 3. Establece conexión con la base de datos.
            $conectar = parent::conexion();
            // 4. Establece el conjunto de caracteres a UTF-8.
            parent::set_names();

            // 5. Prepara la consulta SQL para seleccionar todas las categorías activas.
            $sql = "SELECT * FROM tm_categoria WHERE est = 1";
            $sql = $conectar -> prepare($sql);

            // 6. Ejecuta la consulta.
            $sql -> execute();

            // 7. Retorna los resultados como un array asociativo.
            return $resultado = $sql -> fetchAll(PDO::FETCH_ASSOC);
        }

        // 8. Obtiene una categoría por su ID.
        public function get_categoria_x_id($cat_id) {
            $conectar = parent::conexion();
            parent::set_names();

            // 9. Prepara la consulta SQL para seleccionar una categoría por ID.
            $sql = "SELECT * FROM tm_categoria WHERE est = 1 AND cat_id = ?";
            $sql = $conectar -> prepare($sql);

            // 10. Vincula el ID de la categoría al parámetro de la consulta.
            $sql -> bindValue(1, $cat_id);

            // 11. Ejecuta la consulta.
            $sql -> execute();

            // 12. Retorna los resultados.
            return $resultado = $sql -> fetchAll(PDO::FETCH_ASSOC);
        }

        // 14. Inserta una nueva categoría en la base de datos.
        public function insert_categoria($cat_nom, $cat_obs) {
            $conectar = parent::conexion();
            parent::set_names();

            // 15. Prepara la consulta SQL para insertar una nueva categoría.
            $sql = "INSERT INTO tm_categoria(cat_id, cat_nom, cat_obs, est) VALUES (NULL, ?, ?, '1');";
            $sql = $conectar -> prepare($sql);

            // 16. Vincula los valores de nombre y observación de la categoría a la consulta.
            $sql -> bindValue(1, $cat_nom);
            $sql -> bindValue(2, $cat_obs);

            // 17. Ejecuta la consulta.
            $sql -> execute();

            // 18. Retorna los resultados.
            return $resultado = $sql -> fetchAll(PDO::FETCH_ASSOC);
        }

        // 19. Actualiza una categoría existente en la base de datos.
        public function update_categoria($cat_id, $cat_nom, $cat_obs) {
            $conectar = parent::conexion();
            parent::set_names();

            // 20. Prepara la consulta SQL para actualizar una categoría.
            $sql = "UPDATE tm_categoria set cat_nom = ?, cat_obs = ? WHERE cat_id = ?";
            $sql = $conectar -> prepare($sql);

            // 21. Vincula los nuevos valores a la consulta.
            $sql -> bindValue(1, $cat_nom);
            $sql -> bindValue(2, $cat_obs);
            $sql -> bindValue(3, $cat_id);

            // 22. Ejecuta la consulta.
            $sql -> execute();

            // 23. Retorna los resultados.
            return $resultado = $sql -> fetchAll(PDO::FETCH_ASSOC);
        }

        // 24. Define el método para eliminar una categoría por su ID.
        public function delete_categoria($cat_id) {
            // 25. Establece conexión con la base de datos.
            $conectar = parent::conexion();
            // 26. Configura la codificación de caracteres a UTF-8.
            parent::set_names();
            // 27. Prepara la consulta SQL para eliminar una categoría específica.
            $sql = "DELETE FROM tm_categoria WHERE cat_id = ?";
            $sql = $conectar->prepare($sql);
            // 28. Vincula el valor del ID de categoría al parámetro de la consulta.
            $sql->bindValue(1, $cat_id);
            // 29. Ejecuta la consulta y evalúa si la operación fue exitosa.
            if ($sql->execute()) {
                return true; // Indica una operación exitosa.
            } else {
                return false; // Indica un fallo en la operación.
            }
        }
    }
?>
