<?php
    // 1. Permite solicitudes de cualquier origen para soportar CORS.
    header("Access-Control-Allow-Origin: *");
    // 2. Permite los métodos GET y POST para las solicitudes HTTP.
    header("Access-Control-Allow-Methods: GET, POST");
    // 3. Establece los encabezados permitidos para las solicitudes.
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    // 4. Establece el tipo de contenido de la respuesta a JSON.
    header('Content-Type: application/json');

    // 5. Define la clase Categoria que extiende de Conectar para utilizar la conexión a la base de datos.
    Class Categoria extends Conectar {
        // 6. Obtiene todas las categorías activas de la base de datos.
        public function get_categoria() {
            // 7. Establece conexión con la base de datos.
            $conectar = parent::conexion();
            // 8. Establece el conjunto de caracteres a UTF-8.
            parent::set_names();

            // 9. Prepara la consulta SQL para seleccionar todas las categorías activas.
            $sql = "SELECT * FROM tm_categoria WHERE est = 1";
            $sql = $conectar -> prepare($sql);

            // 10. Ejecuta la consulta.
            $sql -> execute();

            // 11. Retorna los resultados como un array asociativo.
            return $resultado = $sql -> fetchAll(PDO::FETCH_ASSOC);
        }

        // 12. Obtiene una categoría por su ID.
        public function get_categoria_x_id($cat_id) {
            $conectar = parent::conexion();
            parent::set_names();

            // 13. Prepara la consulta SQL para seleccionar una categoría por ID.
            $sql = "SELECT * FROM tm_categoria WHERE est = 1 AND cat_id = ?";
            $sql = $conectar -> prepare($sql);

            // 14. Vincula el ID de la categoría al parámetro de la consulta.
            $sql -> bindValue(1, $cat_id);

            // 15. Ejecuta la consulta.
            $sql -> execute();

            // 16. Retorna los resultados.
            return $resultado = $sql -> fetchAll(PDO::FETCH_ASSOC);
        }

        // 17. Inserta una nueva categoría en la base de datos.
        public function insert_categoria($cat_nom, $cat_obs) {
            $conectar = parent::conexion();
            parent::set_names();

            // 18. Prepara la consulta SQL para insertar una nueva categoría.
            $sql = "INSERT INTO tm_categoria(cat_id, cat_nom, cat_obs, est) VALUES (NULL, ?, ?, '1');";
            $sql = $conectar -> prepare($sql);

            // 19. Vincula los valores de nombre y observación de la categoría a la consulta.
            $sql -> bindValue(1, $cat_nom);
            $sql -> bindValue(2, $cat_obs);

            // 20. Ejecuta la consulta.
            $sql -> execute();

            // 21. Retorna los resultados.
            return $resultado = $sql -> fetchAll(PDO::FETCH_ASSOC);
        }

        // 22. Actualiza una categoría existente en la base de datos.
        public function update_categoria($cat_id, $cat_nom, $cat_obs) {
            $conectar = parent::conexion();
            parent::set_names();

            // 23. Prepara la consulta SQL para actualizar una categoría.
            $sql = "UPDATE tm_categoria set cat_nom = ?, cat_obs = ? WHERE cat_id = ?";
            $sql = $conectar -> prepare($sql);

            // 24. Vincula los nuevos valores a la consulta.
            $sql -> bindValue(1, $cat_nom);
            $sql -> bindValue(2, $cat_obs);
            $sql -> bindValue(3, $cat_id);

            // 25. Ejecuta la consulta.
            $sql -> execute();

            // 26. Retorna los resultados.
            return $resultado = $sql -> fetchAll(PDO::FETCH_ASSOC);
        }

        // 27. Define el método para eliminar una categoría por su ID.
        public function delete_categoria($cat_id) {
            // 28. Establece conexión con la base de datos.
            $conectar = parent::conexion();
            // 29. Configura la codificación de caracteres a UTF-8.
            parent::set_names();
            // 30. Prepara la consulta SQL para eliminar una categoría específica.
            $sql = "DELETE FROM tm_categoria WHERE cat_id = ?";
            $sql = $conectar->prepare($sql);
            // 31. Vincula el valor del ID de categoría al parámetro de la consulta.
            $sql->bindValue(1, $cat_id);
            // 32. Ejecuta la consulta y evalúa si la operación fue exitosa.
            if ($sql->execute()) {
                return true; // Indica una operación exitosa.
            } else {
                return false; // Indica un fallo en la operación.
            }
        }
    }
?>
