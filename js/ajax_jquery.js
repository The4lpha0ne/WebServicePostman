$(document).ready(function() {
    // 1. Función para obtener y mostrar la lista de 
    // categorías
    function obtenerCategorias() {
        // 2. Realiza una petición AJAX con jQuery para 
        // obtener las categorías
        $.ajax({
            url: 'http://localhost/PERSONAL_WebServicePostman/controller/categoria_controller.php?op=GetAll',
            // 3. Tipo de solicitud HTTP
            type: 'GET', 
            // 4. Tipo de datos esperados en la respuesta
            dataType: 'json',
            // 5. Función a ejecutar si la solicitud 
            // es exitosa
            success: function(response) {
                // 6. Inicializa la variable para almacenar 
                // el HTML
                let htmlCategorias = '';
                // 7. Itera sobre cada categoría en la 
                // respuesta
                response.forEach(categoria => {
                    // 8.Construye el HTML para cada 
                    // categoría
                    htmlCategorias += 
                    `<li>
                        ${categoria.cat_nom} - ${categoria.cat_obs}
                        <br>
                        <button class="boton_editar" onclick="mostrarEditarCategoria(${categoria.cat_id}, '${categoria.cat_nom}', '${categoria.cat_obs}')">Editar</button>
                        <button class="boton_eliminar" onclick="eliminarCategoria(${categoria.cat_id})">Eliminar</button>
                    </li>
                    <div class="linea_horizontal3"></div>`;
                });
                // 9. Se utiliza jQuery para asignar el 
                // HTML construido al elemento con ID 
                // listaCategorias
                $('#listaCategorias').html(htmlCategorias);
            },
            // 10. Función a ejecutar si la solicitud 
            // falla
            error: function() {
                alert('Error al obtener categorías');
            }
        });
    }

    // 11. Función para obtener y mostrar la lista de 
    // productos
    function obtenerProductos() {
        // 12. Realiza una petición AJAX con jQuery para 
        // obtener los productos
        $.ajax({
            url: 'http://localhost/PERSONAL_WebServicePostman/controller/producto_controller.php?op=GetAllProductos',
            type: 'GET',
            dataType: 'json',
            // 13. Función a ejecutar si la solicitud 
            // es exitosa
            success: function(response) {
                let htmlProductos = '';
                // 14. Recorre cada producto recibido en 
                // la respuesta
                response.forEach(producto => {
                    // 15. Crea el HTML para cada producto 
                    // con botones de editar y eliminar
                    htmlProductos += 
                    `<li>
                        ${producto.prod_nom} - ${producto.prod_desc} - ${producto.prod_precio}
                        <br>
                        <button class="boton_editar" onclick="mostrarEditarProducto(${producto.prod_id}, ${producto.cat_id}, '${producto.prod_nom}', '${producto.prod_desc}', ${producto.prod_precio})">Editar</button>
                        <button class="boton_eliminar" onclick="eliminarProducto(${producto.prod_id})">Eliminar</button>
                    </li>
                    <div class="linea_horizontal3"></div>`;
                });
                // 16. Se utiliza jQuery para insertar el 
                // HTML de los productos en el documento
                $('#listaProductos').html(htmlProductos);
            },
            // 17. Función a ejecutar si la solicitud falla
            error: function() {
                alert('Error al obtener productos');
            }
        });
    }

    // 18. Define la función para mostrar el formulario 
    // de edición de categoría
    window.mostrarEditarCategoria = 
    function(cat_id, cat_nom, cat_obs) {
        // 19. Se utiliza jQuery para asignar 
        // valores y mostrar el formulario

        // 20. Asigna el ID de la categoría al campo 
        // correspondiente en el formulario de edición
        $('#edit_cat_id').val(cat_id);

        // 21. Asigna el nombre de la categoría al campo 
        // de texto 'Nombre' en el formulario de edición
        $('#edit_cat_nom').val(cat_nom);

        // 22. Asigna las observaciones de la categoría al 
        // campo de texto 'Observaciones' en el formulario 
        // de edición
        $('#edit_cat_obs').val(cat_obs);

        // 23. Hace visible el formulario de edición al 
        // usuario para que pueda realizar cambios
        $('#editCategoriaForm').show();
    };

    // 24. Muestra el formulario de edición para 
    // producto
    window.mostrarEditarProducto = 
    function(
        prod_id, cat_id, prod_nom, prod_desc, prod_precio
    ) {
        $('#edit_prod_id').val(prod_id);
        $('#edit_prod_cat_id').val(cat_id);
        $('#edit_prod_nom').val(prod_nom);
        $('#edit_prod_desc').val(prod_desc);
        $('#edit_prod_precio').val(prod_precio);
        $('#editProductoForm').show();
    };

    // 25. Guarda los cambios de la categoría 
    // editada
    window.submitEditCategoria = function() {
        // 26. Recupera el valor del ID de la categoría 
        // desde el campo de formulario correspondiente
        var cat_id = $('#edit_cat_id').val();

        // 27. Recupera el nombre actualizado de la 
        // categoría desde el campo de texto 'Nombre' 
        // en el formulario
        var cat_nom = $('#edit_cat_nom').val();

        // 28. Recupera las observaciones actualizadas de 
        // la categoría desde el campo de texto 
        // 'Observaciones'
        var cat_obs = $('#edit_cat_obs').val();

        // 29. Inicia una solicitud AJAX utilizando jQuery 
        // para actualizar los datos de una categoría
        $.ajax({
            // 30. Especifica la URL del servidor donde se 
            // enviará la solicitud POST. Esta URL apunta al 
            // controlador de categorías que maneja la 
            // actualización de datos en el servidor
            url: 'http://localhost/PERSONAL_WebServicePostman/controller/categoria_controller.php?op=Update',

            // 31. Define el método HTTP como POST, ya que se 
            // está enviando datos para actualizar una entidad
            type: 'POST',
            
            // 32. Indica que el contenido enviado está en 
            // formato JSON, un formato ligero de intercambio 
            // de datos
            contentType: 'application/json',

            // 33. Convierte los datos del formulario (ID, 
            // nombre y observaciones de la categoría) a una 
            // cadena JSON para enviar al servidor
            data: JSON.stringify({ cat_id, cat_nom, cat_obs }),

            // 34. Función que se ejecutará si la solicitud al 
            // servidor es exitosa
            success: function(response) {
                // 35. Muestra una alerta al usuario indicando 
                // que la categoría ha sido actualizada 
                // correctamente
                alert('Categoría actualizada correctamente');

                // 36. Llama a la función obtenerCategorias() 
                // para refrescar la lista de categorías 
                // mostrada al usuario
                obtenerCategorias();

                // 37. Oculta el formulario de edición de 
                // categoría, indicando que la edición ha 
                // concluido
                $('#editCategoriaForm').hide();
            },

            // 38. Función que se ejecutará si hay un error 
            // en la solicitud
            error: function() {
                // 39. Muestra una alerta al usuario indicando 
                // que ocurrió un error durante la 
                // actualización de la categoría
                alert('Error al actualizar categoría');
            }
        });
    };

    // 40. Define la función para guardar los cambios 
    // del producto editado
    window.submitEditProducto = function() {
        var prod_id = $('#edit_prod_id').val();
        var cat_id = $('#edit_prod_cat_id').val();
        var prod_nom = $('#edit_prod_nom').val();
        var prod_desc = $('#edit_prod_desc').val();
        var prod_precio = $('#edit_prod_precio').val();

        // 41. Realiza una solicitud AJAX con jQuery 
        // para actualizar el producto
        $.ajax({
            // 42. Define la URL del endpoint al que se enviará 
            // la solicitud POST. Este endpoint se encarga de 
            // la lógica para actualizar la información de 
            // un producto en el servidor
            url: 'http://localhost/PERSONAL_WebServicePostman/controller/producto_controller.php?op=UpdateProducto',

            // 43. Especifica el método HTTP a usar. POST se 
            // utiliza aquí porque se está enviando datos al 
            // servidor para actualizar un recurso existente
            type: 'POST',

            // 44. Define el tipo de contenido que se enviará al 
            // servidor. Al especificar 'application/json',
            // se comunica al servidor que los datos enviados 
            // están en formato JSON
            contentType: 'application/json',

            // 45. Los datos que serán enviados al servidor en 
            // formato JSON. Aquí, se convierten las 
            // variables prod_id, cat_id, prod_nom, prod_desc, 
            // prod_precio a una cadena JSON
            data: JSON.stringify({ 
                prod_id, cat_id, prod_nom, prod_desc, prod_precio 
            }),

            // 46. Función que se ejecutará si la solicitud es 
            // exitosa. 'response' contiene la respuesta del 
            // servidor
            success: function(response) {
                // 47. Muestra una alerta al usuario indicando 
                // que el producto ha sido actualizado 
                // correctamente
                alert('Producto actualizado correctamente');

                // 48. Llama a la función obtenerProductos() 
                // para refrescar la lista de productos 
                // mostrados.
                obtenerProductos();

                // 49. Oculta el formulario de edición del 
                // producto después de la actualización 
                // exitosa.
                $('#editProductoForm').hide();
            },

            // 50. Función que se ejecutará si hay un error 
            // en la solicitud
            error: function() {
                // 51. Muestra una alerta al usuario indicando 
                // que hubo un error al actualizar el 
                // producto
                alert('Error al actualizar producto');
            }
        });
    };

    // 52. Define la función para eliminar una categoría
    window.eliminarCategoria = function(cat_id) {
        if(confirm("¿Estás seguro de querer eliminar esta categoría?")) {
            // 53. Realiza una solicitud AJAX con jQuery 
            // para eliminar la categoría
            $.ajax({
                url: 'http://localhost/PERSONAL_WebServicePostman/controller/categoria_controller.php?op=Delete',
                type: 'POST',
                data: JSON.stringify({ cat_id }),
                contentType: 'application/json; charset=utf-8',
                success: function(response) {
                    alert('Categoría eliminada correctamente');
                    obtenerCategorias();
                },
                error: function() {
                    alert('Error al eliminar categoría');
                }
            });
        }
    };

    // 54. Define la función para eliminar un producto
    window.eliminarProducto = function(prod_id) {
        if(confirm(
            "¿Estás seguro de querer eliminar este producto?"
        )) {
            // 55. Realiza una solicitud AJAX con jQuery 
            // para eliminar el producto
            $.ajax({
                url: 'http://localhost/PERSONAL_WebServicePostman/controller/producto_controller.php?op=DeleteProducto',
                type: 'POST',
                data: JSON.stringify({ prod_id }),
                contentType: 'application/json; charset=utf-8',
                success: function(response) {
                    alert('Producto eliminado correctamente');
                    obtenerProductos();
                },
                error: function() {
                    alert('Error al eliminar producto');
                }
            });
        }
    };

    // 56. Asocia el evento 'submit' al formulario identificado 
    // por '#addCategoriaForm'. Esto significa que cuando el 
    // formulario se intente enviar, se ejecutará la función 
    /// definida aquí.
    $('#addCategoriaForm').submit(function(e) {
        // 57. Previene el comportamiento predeterminado del 
        // formulario al enviarlo, que sería recargar la 
        // página. Esto es crucial para permitir una 
        // interacción sin recargas, manteniendo la página 
        // estática mientras se envían los datos al servidor
        e.preventDefault();

        // 58. Recupera el valor ingresado en el campo de 
        // nombre de la categoría
        var cat_nom = $('#cat_nom').val();

        // 59. Recupera el valor ingresado en el campo de 
        // observaciones de la categoría
        var cat_obs = $('#cat_obs').val();

        // 60. Inicia una solicitud AJAX para enviar los datos 
        // al servidor y añadir una nueva categoría
        $.ajax({
            // 61. Especifica la URL del script del servidor 
            // que manejará la inserción de la categoría
            url: 'http://localhost/PERSONAL_WebServicePostman/controller/categoria_controller.php?op=Insert',

            // 62. Utiliza el método POST para enviar los datos, 
            // adecuado para la creación de recursos
            type: 'POST',
            // 63. Indica que el contenido que se está enviando 
            // es de tipo JSON
            contentType: 'application/json',

            // 64. Convierte los datos del formulario (nombre 
            // y observaciones de la categoría) a una cadena 
            // JSON
            data: JSON.stringify({ cat_nom, cat_obs }),

            // 65. Función a ejecutar si la solicitud es 
            // exitosa.
            success: function(response) {
                // 66. Muestra una alerta informando al usuario 
                // que la categoría fue añadida correctamente
                alert('Categoría añadida correctamente');

                // 67. Resetea el formulario para limpiar los 
                // campos después de la inserción exitosa

                // 68. Resetea el formulario 'addCategoriaForm' 
                // a sus valores predeterminados después de 
                // enviar los datos. Se lo realiza accediendo 
                // al primer elemento del selector jQuery con 
                // '[0]' para obtener el elemento de formulario
                // nativo de DOM y luego aplicando el método 
                // 'reset()'. Esto limpia todos los campos, 
                // preparando el formulario para una nueva 
                // entrada
                $('#addCategoriaForm')[0].reset();

                // 69. Llama a la función obtenerCategorias() 
                // para actualizar la lista de categorías 
                // mostradas
                obtenerCategorias();
            },

            // 70. Función a ejecutar si ocurre un error en la 
            // solicitud
            error: function() {
                // 71. Muestra una alerta informando al usuario 
                // que hubo un error al añadir la categoría
                alert('Error al añadir categoría');
            }
        });
    });

    // 72. Define la función para añadir un nuevo 
    // producto mediante el formulario
    $('#addProductoForm').submit(function(e) {
        e.preventDefault();
        var cat_id = $('#prod_cat_id').val();
        var prod_nom = $('#prod_nom').val();
        var prod_desc = $('#prod_desc').val();
        var prod_precio = $('#prod_precio').val();
        // 73. Realiza una solicitud AJAX con jQuery 
        // para insertar el nuevo producto
        $.ajax({
            url: 'http://localhost/PERSONAL_WebServicePostman/controller/producto_controller.php?op=InsertProducto',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ 
                cat_id, prod_nom, prod_desc, prod_precio 
            }),
            // 74. Función a ejecutar si la solicitud 
            // es exitosa
            success: function(response) {
                alert('Producto añadido correctamente');
                // 75. Se utiliza jQuery para resetear el 
                // formulario
                $('#addProductoForm')[0].reset();
                obtenerProductos();
            },
            // 76. Función a ejecutar si la solicitud 
            // falla
            error: function() {
                alert('Error al añadir producto');
            }
        });
    });

    // 77. Inicializa las listas de categorías y 
    // productos al cargar la página
    obtenerCategorias();
    obtenerProductos();
});
