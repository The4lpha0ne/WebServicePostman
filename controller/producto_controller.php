<?php
    /**
     * Controlador para la gestión de productos mediante 
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
    require_once("../models/Producto_models.php");

    // 5. Crea una instancia del modelo de producto.
    /**
     * Es una instancia del modelo de producto para 
     * realizar operaciones CRUD.
     * 
     * @var Producto $producto Instancia del modelo de producto.
     * @access public
     */
    $producto = new Producto();

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
        // 8. Caso para insertar un nuevo producto.
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

        // 9. Caso para actualizar un producto.
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

        // 10. Caso para eliminar un producto.
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

        // 11. Caso para obtener todos los productos.
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
?>