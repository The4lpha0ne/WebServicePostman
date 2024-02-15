<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Content-Type: application/json");

    // Datos de conexión a la base de datos
    $host = "localhost";
    $dbname = "richardfvg_webservice";
    $username = "root";
    $password = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Asegurarse de que la solicitud sea POST
        try {
            // Crear una nueva conexión PDO directamente
            $dbh = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Ejecutar la consulta para restablecer AUTO_INCREMENT
            $sql = "ALTER TABLE tm_producto AUTO_INCREMENT = 1;";
            $dbh->exec($sql);

            echo json_encode(["message" => "AUTO_INCREMENT restablecido correctamente."]);
        } catch (PDOException $e) {
            http_response_code(500); // Error del servidor
            echo json_encode(["message" => "Error al restablecer AUTO_INCREMENT: " . $e->getMessage()]);
        }
    } else {
        http_response_code(405); // Método no permitido
        echo json_encode(["message" => "Método no permitido"]);
    }

    // ALTER TABLE tm_producto AUTO_INCREMENT = 1;
?>
