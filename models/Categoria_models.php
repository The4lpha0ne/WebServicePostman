<?php
    /**
     * Script para gestionar las categorías mediante una API, 
     * permitiendo realizar operaciones CRUD.
     * 
     * Permite el acceso desde cualquier origen y soporta los 
     * métodos GET y POST.
     * 
     * Se utiliza para manejar las categorías activas en una 
     * base de datos, incluyendo la obtención de todas las 
     * categorías, una categoría por ID, inserción, 
     * actualización y eliminación de categorías.
     */

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    header('Content-Type: application/json');

    // 1. 
    /**
     * Es la clase Categoria que extiende de Conectar para 
     * utilizar la conexión a la base de datos.
     * 
     * @access public
     */
    Class Categoria extends Conectar {
        // 2. 
        /**
         * Obtiene todas las categorías activas de la base de 
         * datos.
         * 
         * Realiza una consulta para obtener todas las 
         * categorías que están marcadas como activas.
         * 
         * @access public
         * @return array Asociativo con todas las categorías 
         * activas.
         */
        public function get_categoria() {
            // 3. Establece conexión con la base de datos
            $conectar = parent::conexion();

            // 4. Establece el conjunto de caracteres a UTF-8
            parent::set_names();

            // 5. Prepara la consulta SQL para seleccionar 
            // todas las categorías activas
            $sql = "SELECT * FROM tm_categoria WHERE est = 1";
            $sql = $conectar -> prepare($sql);
            $sql -> execute();

            // 6. Retorna los resultados como un array 
            // asociativo
            return $resultado = 
            $sql -> fetchAll(PDO::FETCH_ASSOC);
        }

        // 7. 
        /**
         * Obtiene una categoría por su ID.
         * 
         * Realiza una consulta para obtener los detalles de 
         * una categoría específica por su identificador 
         * único.
         * 
         * @access public
         * @param int $cat_id ID de la categoría a obtener.
         * @return array Asociativo con la categoría solicitada.
         */
        public function get_categoria_x_id($cat_id) {
            $conectar = parent::conexion();
            parent::set_names();

            // 8. Prepara la consulta SQL para seleccionar 
            // una categoría por ID
            $sql = 
            "SELECT * FROM tm_categoria 
            WHERE est = 1 AND cat_id = ?";

            $sql = $conectar -> prepare($sql);

            // 9. Vincula el ID de la categoría al parámetro 
            // de la consulta
            $sql -> bindValue(1, $cat_id);
            $sql -> execute();

            // 10. Retorna los resultados
            return $resultado = 
            $sql -> fetchAll(PDO::FETCH_ASSOC);
        }

        // 11. 
        /**
         * Inserta una nueva categoría en la base de datos.
         * 
         * Añade una nueva categoría con un nombre y 
         * observaciones opcionales.
         * 
         * @access public
         * @param string $cat_nom Nombre de la nueva categoría.
         * @param string $cat_obs Observaciones de la nueva 
         * categoría.
         * 
         * @return array Asociativo con el resultado de la 
         * operación.
         */
        public function insert_categoria($cat_nom, $cat_obs) {
            $conectar = parent::conexion();
            parent::set_names();

            // 12. Prepara la consulta SQL para insertar una 
            // nueva categoría
            $sql = 
            "INSERT INTO tm_categoria(cat_id, cat_nom, cat_obs, est) 
            VALUES (NULL, ?, ?, '1');";

            $sql = $conectar -> prepare($sql);

            // 13. Vincula los valores de nombre y observación de 
            // la categoría a la consulta.
            $sql -> bindValue(1, $cat_nom);
            $sql -> bindValue(2, $cat_obs);
            $sql -> execute();

            // 14. Retorna los resultados.
            return $resultado = $sql -> fetchAll(PDO::FETCH_ASSOC);
        }

        // 15. 
        /**
         * Actualiza una categoría existente en la base de datos.
         * 
         * Modifica los datos de una categoría existente basándose 
         * en su ID.
         * 
         * @access public
         * @param int $cat_id ID de la categoría a actualizar.
         * @param string $cat_nom Nuevo nombre de la categoría.
         * @param string $cat_obs Nuevas observaciones de la categoría.
         * @return array Asociativo con el resultado de la operación.
         */
        public function update_categoria($cat_id, $cat_nom, $cat_obs) {
            $conectar = parent::conexion();
            parent::set_names();

            // 16. Prepara la consulta SQL para actualizar una 
            // categoría.
            $sql = 
            "UPDATE tm_categoria set cat_nom = ?, cat_obs = ? 
            WHERE cat_id = ?";

            $sql = $conectar -> prepare($sql);

            // 17. Vincula los nuevos valores a la consulta.
            $sql -> bindValue(1, $cat_nom);
            $sql -> bindValue(2, $cat_obs);
            $sql -> bindValue(3, $cat_id);
            $sql -> execute();

            // 18. Retorna los resultados.
            return $resultado = 
            $sql -> fetchAll(PDO::FETCH_ASSOC);
        }

        // 19. 
        /**
         * Define el método para eliminar una categoría por 
         * su ID.
         * 
         * Elimina de la base de datos la categoría 
         * especificada por el ID proporcionado.
         * 
         * @access public
         * @param int $cat_id ID de la categoría a eliminar.
         * @return bool Verdadero si la operación fue exitosa, 
         * falso en caso contrario.
         */
        public function delete_categoria($cat_id) {
            // 20. Establece conexión con la base de datos
            $conectar = parent::conexion();

            // 21. Configura la codificación de caracteres 
            // a UTF-8
            parent::set_names();

            // 22. Prepara la consulta SQL para eliminar una 
            // categoría específica
            $sql = "DELETE FROM tm_categoria WHERE cat_id = ?";
            $sql = $conectar->prepare($sql);

            // 23. Vincula el valor del ID de categoría al 
            // parámetro de la consulta
            $sql->bindValue(1, $cat_id);

            // 24. Ejecuta la consulta y evalúa si la 
            // operación fue exitosa.
            if ($sql->execute()) {
                return true; // Indica una operación exitosa.
            } 
            
            else {
                return false; // Indica un fallo en la operación.
            }
        }
    }
?>
