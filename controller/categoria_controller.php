<?php
    /**
     * Controlador para la gestión de categorías y productos 
     * mediante solicitudes CORS.
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
    require_once("../models/Producto_models.php");

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

    // 6. Crea una instancia del modelo de producto.
    /**
     * Es una instancia del modelo de producto para 
     * realizar operaciones CRUD.
     * 
     * @var Producto $producto Instancia del modelo de producto.
     * @access public
     */
    $producto = new Producto();

    // 7. Obtiene y decodifica el cuerpo de la solicitud HTTP.
    /**
     * Cuerpo de la solicitud HTTP decodificado desde JSON a 
     * un array PHP.
     * 
     * @var array $body Cuerpo de la solicitud.
     * @access public
     */
    $body = 
    json_decode(file_get_contents("php://input"), true);

    // 8. Ejecuta operaciones basadas en el parámetro 'op' 
    // de la solicitud.
    switch($_GET["op"]) {
        // 9. Caso para obtener todas las categorías.
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

        // 10. Caso para obtener una categoría por ID.
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

        // 11. Caso para insertar una nueva categoría.
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

        // 12. Caso para actualizar una categoría.
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

        // 13. Caso para eliminar una categoría.
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

        // 14. Caso para insertar un nuevo producto.
        case "InsertProducto":
            /**
             * Inserta un nuevo producto y devuelve un 
             * mensaje indicando el resultado de la operación 
             * en formato JSON.
             * 
             * Valida si todos los datos necesarios están 
             * presentes antes de realizar la inserción.
             * 
             * @param int $body['cat_id'] ID de la categoría 
             * del producto.
             * 
             * @param string $body['prod_nom'] Nombre del 
             * producto.
             * 
             * @param string $body['prod_desc'] Descripción 
             * del producto.
             * 
             * @param float $body['prod_precio'] Precio del 
             * producto.
             * 
             * @return string Mensaje indicando el resultado de 
             * la operación en formato JSON.
             * 
             * @access public
             */
            if(isset(
                $body['cat_id'], 
                $body['prod_nom'], 
                $body['prod_desc'], 
                $body['prod_precio']
            )) {
                $resultado = 
                $producto->
                insert_producto($body['cat_id'], 
                $body['prod_nom'], 
                $body['prod_desc'], 
                $body['prod_precio']);

                if($resultado) {
                    echo json_encode([
                        "message" => 
                        "Producto insertado correctamente"
                    ]);
                } 
                
                else {
                    echo json_encode([
                        "message" => 
                        "Error al insertar el producto"
                    ]);
                }
            } 
            
            else {
                echo json_encode([
                    "message" => 
                    "Datos incompletos para la inserción del producto"
                ]);
            }
        break;

        // 15. Caso para actualizar un producto.
        case "UpdateProducto":
            /**
             * Actualiza un producto existente y devuelve un 
             * mensaje indicando el resultado de la operación 
             * en formato JSON.
             * 
             * Verifica que todos los datos necesarios estén 
             * completos antes de proceder con la actualización.
             * 
             * @param int $body['prod_id'] ID del producto a 
             * actualizar.
             * 
             * @param int $body['cat_id'] ID de la categoría 
             * del producto.
             * 
             * @param string $body['prod_nom'] Nuevo nombre 
             * del producto.
             * 
             * @param string $body['prod_desc'] Nueva 
             * descripción del producto.
             * 
             * @param float $body['prod_precio'] Nuevo precio 
             * del producto.
             * 
             * @return string Mensaje indicando el resultado 
             * de la operación en formato JSON.
             * 
             * @access public
             */
            if(isset(
                $body['prod_id'], 
                $body['cat_id'], 
                $body['prod_nom'], 
                $body['prod_desc'], 
                $body['prod_precio']
            )) {
                $resultado = 
                $producto->
                update_producto($body['prod_id'], 
                $body['cat_id'], $body['prod_nom'], 
                $body['prod_desc'], 
                $body['prod_precio']);

                if($resultado) {
                    echo json_encode([
                        "message" => 
                        "Producto actualizado correctamente"
                    ]);
                } 
                
                else {
                    echo json_encode([
                        "message" => 
                        "Error al actualizar el producto"
                    ]);
                }
            } 
            
            else {
                echo json_encode([
                    "message" => 
                    "Datos incompletos para la actualización del producto"
                ]);
            }
        break;

        // 16. Caso para eliminar un producto.
        case "DeleteProducto":
            /**
             * Elimina un producto especificado por su ID y 
             * devuelve un mensaje indicando el resultado de 
             * la operación en formato JSON.
             * 
             * Confirma que el ID del producto proporcionado 
             * corresponde a un producto existente antes de 
             * proceder con la eliminación.
             * 
             * @param int $body['prod_id'] ID del producto a 
             * eliminar.
             * 
             * @return string Mensaje indicando el resultado 
             * de la operación en formato JSON.
             * 
             * @access public
             */
            if(isset($body['prod_id'])) {
                $resultado = 
                $producto->delete_producto($body['prod_id']);

                if($resultado) {
                    echo json_encode([
                        "message" => 
                        "Producto eliminado correctamente"
                    ]);
                } 
                
                else {
                    echo json_encode([
                        "message" => 
                        "Error al eliminar el producto"
                    ]);
                }
            } 
            
            else {
                echo json_encode([
                    "message" => 
                    "No se especificó el ID del producto para eliminar"
                ]);
            }
        break;

        // 17. Caso para obtener todos los productos.
        case "GetAllProductos":
            /**
             * Obtiene todos los productos disponibles y 
             * los devuelve en formato JSON.
             * 
             * Realiza una consulta a la base de datos para 
             * recuperar todos los productos activos y los 
             * devuelve en un formato legible.
             * 
             * @return string Lista de todos los productos 
             * en formato JSON.
             * 
             * @access public
             */
            $datos = $producto->get_productos();
            
            echo json_encode($datos);
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
