<?php
    // 1. Establece los encabezados para permitir solicitudes de cualquier origen.
    header("Access-Control-Allow-Origin: *");
    // 2. Establece los métodos HTTP permitidos para las solicitudes.
    header("Access-Control-Allow-Methods: GET, POST");
    // 3. Establece el tipo de contenido de la respuesta como JSON.
    header("Content-Type: application/json");

    // 4. Define los datos de conexión a la base de datos.
    $host = "localhost";
    $dbname = "richardfvg_webservice";
    $username = "root";
    $password = "";

    // 5. Comprueba si el método de la solicitud actual es POST.
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            // 6. Establece una nueva conexión PDO con la base de datos.
            $dbh = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            // 7. Configura el atributo de PDO para lanzar una excepción en caso de error.
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // 8. Prepara la consulta SQL para restablecer el AUTO_INCREMENT de la tabla tm_categoria.
            $sql = "ALTER TABLE tm_categoria AUTO_INCREMENT = 1;";
            // 9. Ejecuta la consulta SQL.
            $dbh->exec($sql);

            // 10. Envía una respuesta JSON indicando que el AUTO_INCREMENT se restableció correctamente.
            echo json_encode(["message" => "AUTO_INCREMENT de tm_categoria restablecido correctamente."]);
        } catch (PDOException $e) {
            // 11. Establece el código de respuesta HTTP a 500 en caso de error en el servidor.
            http_response_code(500);
            // 12. Envía una respuesta JSON indicando el error al restablecer el AUTO_INCREMENT.
            echo json_encode(["message" => "Error al restablecer AUTO_INCREMENT de tm_categoria: " . $e->getMessage()]);
        }
    } else {
        // 13. Establece el código de respuesta HTTP a 405 si el método de la solicitud no es POST.
        http_response_code(405);
        // 14. Envía una respuesta JSON indicando que el método no está permitido.
        echo json_encode(["message" => "Método no permitido"]);
    }
?>
