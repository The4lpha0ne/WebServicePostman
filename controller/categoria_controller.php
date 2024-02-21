<?php
    /**
     * Controlador para la gestión de categorías mediante 
     * solicitudes CORS.
     * 
     * Permite solicitudes CORS desde cualquier origen y 
     * establece los encabezados adecuados para soportar 
     * métodos GET y POST, así como la inclusión de ciertos 
     * encabezados en las solicitudes.
     * 
     * La respuesta siempre se devuelve en formato JSON.
     * 
     * @access public
     */

    // 1. Permite solicitudes de cualquier origen.
    header("Access-Control-Allow-Origin: *");
    // 2. Permite los métodos GET y POST.
    header("Access-Control-Allow-Methods: GET, POST");
    // 3. Establece los encabezados permitidos para las 
    // solicitudes.
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    // 4. Establece el tipo de contenido de la respuesta 
    // a JSON.
    header('Content-Type: application/json');

    require_once("../config/conexion.php");
    require_once("../models/Categoria_models.php");

    // 5. Crea una instancia del modelo de categoría.
    /**
     * Es una instancia del modelo de categoría para 
     * realizar operaciones CRUD.
     * 
     * @var Categoria $categoria Instancia del modelo de 
     * categoría.
     * 
     * @access public
     */
    $categoria = new Categoria();

    // 6. Obtiene y decodifica el cuerpo de la solicitud HTTP.
    /**
     * Cuerpo de la solicitud HTTP decodificado desde JSON a 
     * un array PHP.
     * 
     * @var array $body Cuerpo de la solicitud.
     * @access public
     */
    $body = 
    json_decode(file_get_contents("php://input"), true);

    // 7. Ejecuta operaciones basadas en el parámetro 'op' 
    // de la solicitud.
    switch($_GET["op"]) {
        // 8. Caso para obtener todas las categorías.
        case "GetAll":
            /**
             * Obtiene todas las categorías y las devuelve en 
             * formato JSON.
             * 
             * @return string Lista de todas las categorías en 
             * formato JSON.
             * 
             * @access public
             */
            $datos = $categoria->get_categoria();

            echo json_encode($datos);
        break;

        // 9. Caso para obtener una categoría por ID.
        case "GetId":
            /**
             * Obtiene una categoría por su ID y la devuelve 
             * en formato JSON.
             * 
             * @param int $body["cat_id"] ID de la categoría.
             * @return string Datos de la categoría especificada 
             * en formato JSON.
             * 
             * @access public
             */
            $datos = 
            $categoria->get_categoria_x_id($body["cat_id"]);

            echo json_encode($datos);
        break;

        // 10. Caso para insertar una nueva categoría.
        case "Insert":
            /**
             * Inserta una nueva categoría y devuelve un 
             * mensaje de éxito en formato JSON.
             * 
             * @param string $body["cat_nom"] Nombre de la 
             * categoría.
             * 
             * @param string $body["cat_obs"] Observaciones de 
             * la categoría.
             * 
             * @return string Mensaje de éxito en formato JSON.
             * @access public
             */
            $datos = 
            $categoria->
            insert_categoria($body["cat_nom"], 
            $body["cat_obs"]);

            echo json_encode("Insert Correcto");
        break;

        // 11. Caso para actualizar una categoría.
        case "Update":
            /**
             * Actualiza una categoría existente y devuelve 
             * un mensaje de éxito en formato JSON.
             * 
             * Verifica que el ID de la categoría exista antes 
             * de proceder con la actualización y valida los 
             * datos de entrada.
             * 
             * @param int $body["cat_id"] ID de la categoría a 
             * actualizar.
             * 
             * @param string $body["cat_nom"] Nuevo nombre de 
             * la categoría.
             * 
             * @param string $body["cat_obs"] Nuevas 
             * observaciones de la categoría.
             * 
             * @return string Mensaje de éxito en formato JSON.
             * @access public
             */
            $datos = 
            $categoria->
            update_categoria($body["cat_id"], 
            $body["cat_nom"], 
            $body["cat_obs"]);

            echo json_encode("Update Correcto");
        break;

        // 12. Caso para eliminar una categoría.
        case "Delete":
            /**
             * Elimina una categoría por su ID y devuelve 
             * un mensaje de éxito en formato JSON.
             * 
             * Asegura que la categoría a eliminar exista 
             * antes de proceder con la operación.
             * 
             * @param int $body["cat_id"] ID de la categoría a 
             * eliminar.
             * 
             * @return string Mensaje de éxito en formato JSON.
             * @access public
             */
            $datos = 
            $categoria->delete_categoria($body["cat_id"]);

            echo json_encode("Delete Correcto");
        break;
    }

    // http://localhost/PERSONAL_WebServicePostman/controller/categoria.php?op=GetAll
    // http://localhost/PERSONAL_WebServicePostman/controller/categoria.php?op=GetId
    // http://localhost/PERSONAL_WebServicePostman/controller/categoria.php?op=Insert
    // http://localhost/PERSONAL_WebServicePostman/controller/categoria.php?op=Update
    // http://localhost/PERSONAL_WebServicePostman/controller/categoria.php?op=Delete
    // http://localhost/PERSONAL_WebServicePostman/controller/categoria_controller.php?op=InsertProducto
    // http://localhost/PERSONAL_WebServicePostman/controller/categoria_controller.php?op=UpdateProducto
    // http://localhost/PERSONAL_WebServicePostman/controller/categoria_controller.php?op=DeleteProducto
    // http://localhost/PERSONAL_WebServicePostman/A_increment/resetAutoIncrement.php
    // http://localhost/PERSONAL_WebServicePostman/A_increment/resetAutoIncrement2.php
?>
