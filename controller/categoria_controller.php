<?php
    // 1. Permite solicitudes de cualquier origen.
    header("Access-Control-Allow-Origin: *");
    // 2. Permite los métodos GET y POST.
    header("Access-Control-Allow-Methods: GET, POST");
    // 3. Establece los encabezados permitidos para las solicitudes.
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    // 4. Establece el tipo de contenido de la respuesta a JSON.
    header('Content-Type: application/json');

    require_once("../config/conexion.php");
    require_once("../models/Categoria_models.php");
    require_once("../models/Producto_models.php");

    // 5. Crea una instancia del modelo de categoría.
    $categoria = new Categoria();
    // 6. Crea una instancia del modelo de producto.
    $producto = new Producto();

    // 7. Obtiene y decodifica el cuerpo de la solicitud HTTP.
    $body = json_decode(file_get_contents("php://input"), true);

    // 8. Ejecuta operaciones basadas en el parámetro 'op' de la solicitud.
    switch($_GET["op"]) {
        // 9. Caso para obtener todas las categorías.
        case "GetAll":
            $datos = $categoria->get_categoria();
            echo json_encode($datos);
        break;

        // 10. Caso para obtener una categoría por ID.
        case "GetId":
            $datos = $categoria->get_categoria_x_id($body["cat_id"]);
            echo json_encode($datos);
        break;

        // 11. Caso para insertar una nueva categoría.
        case "Insert":
            $datos = $categoria->insert_categoria($body["cat_nom"], $body["cat_obs"]);
            echo json_encode("Insert Correcto");
        break;

        // 12. Caso para actualizar una categoría.
        case "Update":
            $datos = $categoria->update_categoria($body["cat_id"], $body["cat_nom"], $body["cat_obs"]);
            echo json_encode("Update Correcto");
        break;

        // 13. Caso para eliminar una categoría.
        case "Delete":
            $datos = $categoria->delete_categoria($body["cat_id"]);
            echo json_encode("Delete Correcto");
        break;

        // 14. Caso para insertar un nuevo producto.
        case "InsertProducto":
            if(isset($body['cat_id'], $body['prod_nom'], $body['prod_desc'], $body['prod_precio'])) {
                $resultado = $producto->insert_producto($body['cat_id'], $body['prod_nom'], $body['prod_desc'], $body['prod_precio']);
                if($resultado) {
                    echo json_encode(["message" => "Producto insertado correctamente"]);
                } else {
                    echo json_encode(["message" => "Error al insertar el producto"]);
                }
            } else {
                echo json_encode(["message" => "Datos incompletos para la inserción del producto"]);
            }
        break;

        // 15. Caso para actualizar un producto.
        case "UpdateProducto":
            if(isset($body['prod_id'], $body['cat_id'], $body['prod_nom'], $body['prod_desc'], $body['prod_precio'])) {
                $resultado = $producto->update_producto($body['prod_id'], $body['cat_id'], $body['prod_nom'], $body['prod_desc'], $body['prod_precio']);
                if($resultado) {
                    echo json_encode(["message" => "Producto actualizado correctamente"]);
                } else {
                    echo json_encode(["message" => "Error al actualizar el producto"]);
                }
            } else {
                echo json_encode(["message" => "Datos incompletos para la actualización del producto"]);
            }
        break;

        // 16. Caso para eliminar un producto.
        case "DeleteProducto":
            if(isset($body['prod_id'])) {
                $resultado = $producto->delete_producto($body['prod_id']);
                if($resultado) {
                    echo json_encode(["message" => "Producto eliminado correctamente"]);
                } else {
                    echo json_encode(["message" => "Error al eliminar el producto"]);
                }
            } else {
                echo json_encode(["message" => "No se especificó el ID del producto para eliminar"]);
            }
        break;

        // 17. Caso para obtener todos los productos.
        case "GetAllProductos":
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
