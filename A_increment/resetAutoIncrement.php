<?php
    /**
     * Este script gestiona solicitudes POST para restablecer 
     * el AUTO_INCREMENT de una tabla específica.
     * 
     * Configura CORS para aceptar solicitudes de cualquier 
     * origen y establece el tipo de contenido de la respuesta 
     * a JSON.
     * 
     * Intenta conectar a una base de datos y restablecer el 
     * valor de AUTO_INCREMENT de la tabla 'tm_producto'.
     * 
     * Es crucial usar este script con precaución, especialmente 
     * en entornos de producción, ya que restablecer 
     * AUTO_INCREMENT puede impactar la integridad de los 
     * datos.
     * 
     * Solo debe realizarse esta operación cuando sea seguro y 
     * apropiado, como durante el mantenimiento de la base de 
     * datos o la inicialización de un entorno de pruebas.
     */

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

    // 5. Comprueba si el método de solicitud es POST.
    /**
     * En caso de ser POST, intenta restablecer el 
     * AUTO_INCREMENT de la tabla 'tm_producto'.
     * 
     * Si ocurre un error, devuelve un mensaje de 
     * error JSON.
     * 
     * Si el método no es POST, envía una respuesta 
     * indicando que el método no está permitido.
     */
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            // 6. Crea una nueva conexión PDO
            $dbh = 
            new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8", 
                $username, 
                $password
            );

            // 7. Configura el modo de error para lanzar 
            // excepciones
            $dbh->setAttribute(
                PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
            );

            // 8. Prepara la consulta SQL para restablecer 
            // AUTO_INCREMENT
            $sql = 
            "ALTER TABLE tm_producto AUTO_INCREMENT = 1;";

            // 9. Ejecuta la consulta SQL
            $dbh->exec($sql);

            // 10. Envía una respuesta JSON indicando el 
            // éxito de la operación
            echo json_encode([
                "message" => 
                "AUTO_INCREMENT restablecido correctamente."
            ]);
        } 
        
        catch (PDOException $e) {
            // 11. Establece el código de respuesta a 500 
            // en caso de error
            http_response_code(500);

            // 12. Envía una respuesta JSON indicando el 
            // error
            echo json_encode([
                "message" => 
                "Error al restablecer AUTO_INCREMENT: " . 
                $e->getMessage()
            ]);
        }
    } 
    
    else {
        // 13. Establece el código de respuesta a 405 si 
        // el método de solicitud no es POST
        http_response_code(405);

        // 14. Envía una respuesta JSON indicando que el 
        // método no está permitido
        echo json_encode([
            "message" => "Método no permitido"
        ]);
    }

    // ALTER TABLE tm_producto AUTO_INCREMENT = 1;
?>
