<?php
    // 1. Permite solicitudes de cualquier origen
    header("Access-Control-Allow-Origin: *");
    // 2. Permite métodos GET y POST para las solicitudes
    header("Access-Control-Allow-Methods: GET, POST");
    // 3. Establece el tipo de contenido de la respuesta a JSON
    header("Content-Type: application/json");

    // 4. Define los datos de conexión a la base de datos
    $host = "localhost";
    $dbname = "richardfvg_webservice";
    $username = "root";
    $password = "";

    // 5. Comprueba si el método de solicitud es POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            // 6. Crea una nueva conexión PDO
            $dbh = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            // 7. Configura el modo de error para lanzar excepciones
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // 8. Prepara la consulta SQL para restablecer AUTO_INCREMENT
            $sql = "ALTER TABLE tm_producto AUTO_INCREMENT = 1;";
            // 9. Ejecuta la consulta SQL
            $dbh->exec($sql);

            // 10. Envía una respuesta JSON indicando el éxito de la operación
            echo json_encode(["message" => "AUTO_INCREMENT restablecido correctamente."]);
        } catch (PDOException $e) {
            // 11. Establece el código de respuesta a 500 en caso de error
            http_response_code(500);
            // 12. Envía una respuesta JSON indicando el error
            echo json_encode(["message" => "Error al restablecer AUTO_INCREMENT: " . $e->getMessage()]);
        }
    } else {
        // 13. Establece el código de respuesta a 405 si el método de solicitud no es POST
        http_response_code(405);
        // 14. Envía una respuesta JSON indicando que el método no está permitido
        echo json_encode(["message" => "Método no permitido"]);
    }

    // ALTER TABLE tm_producto AUTO_INCREMENT = 1;
?>
