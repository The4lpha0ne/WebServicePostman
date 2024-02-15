<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    header('Content-Type: application/json');

    require_once("../config/conexion.php");
    require_once("../models/Categoria_models.php");
    require_once("../models/Producto_models.php");

    $categoria = new Categoria();
    $producto = new Producto();

    $body = json_decode(file_get_contents("php://input"), true);

    switch($_GET["op"]) {
        case "GetAll":
            $datos = $categoria->get_categoria();
            echo json_encode($datos);
        break;

        case "GetId":
            $datos = $categoria->get_categoria_x_id($body["cat_id"]);
            echo json_encode($datos);
        break;

        case "Insert":
            $datos = $categoria->insert_categoria($body["cat_nom"], $body["cat_obs"]);
            echo json_encode("Insert Correcto");
        break;

        case "Update":
            $datos = $categoria->update_categoria($body["cat_id"], $body["cat_nom"], $body["cat_obs"]);
            echo json_encode("Update Correcto");
        break;

        case "Delete":
            $datos = $categoria->delete_categoria($body["cat_id"]);
            echo json_encode("Delete Correcto");
        break;

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
