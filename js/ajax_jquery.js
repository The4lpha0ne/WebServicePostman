$(document).ready(function() {
    // 1. Función para obtener y mostrar la lista de 
    // categorías
    function obtenerCategorias() {
        // 2. Realiza una petición AJAX para obtener las 
        // categorías
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
                // 9. Asigna el HTML construido al 
                // elemento con ID listaCategorias
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
        // 12. Realiza una petición AJAX para obtener 
        // los productos
        $.ajax({
            url: 'http://localhost/PERSONAL_WebServicePostman/controller/categoria_controller.php?op=GetAllProductos',
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
                // 16. Inserta el HTML de los productos en 
                // el documento
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
    window.mostrarEditarCategoria = function(cat_id, cat_nom, cat_obs) {
        $('#edit_cat_id').val(cat_id);
        $('#edit_cat_nom').val(cat_nom);
        $('#edit_cat_obs').val(cat_obs);
        $('#editCategoriaForm').show();
    };

    // 19. Muestra el formulario de edición para 
    // producto
    window.mostrarEditarProducto = function(prod_id, cat_id, prod_nom, prod_desc, prod_precio) {
        $('#edit_prod_id').val(prod_id);
        $('#edit_prod_cat_id').val(cat_id);
        $('#edit_prod_nom').val(prod_nom);
        $('#edit_prod_desc').val(prod_desc);
        $('#edit_prod_precio').val(prod_precio);
        $('#editProductoForm').show();
    };

    // 20. Guarda los cambios de la categoría 
    // editada
    window.submitEditCategoria = function() {
        var cat_id = $('#edit_cat_id').val();
        var cat_nom = $('#edit_cat_nom').val();
        var cat_obs = $('#edit_cat_obs').val();

        // 21. Realiza una solicitud AJAX para 
        // actualizar la categoría
        $.ajax({
            url: 'http://localhost/PERSONAL_WebServicePostman/controller/categoria_controller.php?op=Update',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ cat_id, cat_nom, cat_obs }),
            // 22. Función a ejecutar si la solicitud 
            // es exitosa
            success: function(response) {
                alert('Categoría actualizada correctamente');
                obtenerCategorias();
                $('#editCategoriaForm').hide();
            },
            // 23. Función a ejecutar si la solicitud 
            // falla
            error: function() {
                alert('Error al actualizar categoría');
            }
        });
    };

    // 24. Define la función para guardar los cambios 
    // del producto editado
    window.submitEditProducto = function() {
        var prod_id = $('#edit_prod_id').val();
        var cat_id = $('#edit_prod_cat_id').val();
        var prod_nom = $('#edit_prod_nom').val();
        var prod_desc = $('#edit_prod_desc').val();
        var prod_precio = $('#edit_prod_precio').val();

        // 25. Realiza una solicitud AJAX para actualizar 
        // el producto
        $.ajax({
            url: 'http://localhost/PERSONAL_WebServicePostman/controller/categoria_controller.php?op=UpdateProducto',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ prod_id, cat_id, prod_nom, prod_desc, prod_precio }),
            success: function(response) {
                alert('Producto actualizado correctamente');
                obtenerProductos();
                $('#editProductoForm').hide();
            },
            error: function() {
                alert('Error al actualizar producto');
            }
        });
    };

    // 26. Define la función para eliminar una categoría
    window.eliminarCategoria = function(cat_id) {
        if(confirm("¿Estás seguro de querer eliminar esta categoría?")) {
            // 27. Realiza una solicitud AJAX para 
            // eliminar la categoría
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

    // 28. Define la función para eliminar un producto
    window.eliminarProducto = function(prod_id) {
        if(confirm("¿Estás seguro de querer eliminar este producto?")) {
            // 29. Realiza una solicitud AJAX para 
            // eliminar el producto
            $.ajax({
                url: 'http://localhost/PERSONAL_WebServicePostman/controller/categoria_controller.php?op=DeleteProducto',
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

    // 30. Define la función para añadir una nueva 
    // categoría mediante el formulario
    $('#addCategoriaForm').submit(function(e) {
        e.preventDefault();
        var cat_nom = $('#cat_nom').val();
        var cat_obs = $('#cat_obs').val();
        // 31. Realiza una solicitud AJAX para insertar 
        // la nueva categoría
        $.ajax({
            url: 'http://localhost/PERSONAL_WebServicePostman/controller/categoria_controller.php?op=Insert',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ cat_nom, cat_obs }),
            success: function(response) {
                alert('Categoría añadida correctamente');
                $('#addCategoriaForm')[0].reset();
                obtenerCategorias();
            },
            error: function() {
                alert('Error al añadir categoría');
            }
        });
    });

    // 32. Define la función para añadir un nuevo 
    // producto mediante el formulario
    $('#addProductoForm').submit(function(e) {
        e.preventDefault();
        var cat_id = $('#prod_cat_id').val();
        var prod_nom = $('#prod_nom').val();
        var prod_desc = $('#prod_desc').val();
        var prod_precio = $('#prod_precio').val();
        // 33. Realiza una solicitud AJAX para insertar 
        // el nuevo producto
        $.ajax({
            url: 'http://localhost/PERSONAL_WebServicePostman/controller/categoria_controller.php?op=InsertProducto',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ cat_id, prod_nom, prod_desc, prod_precio }),
            // 34. Función a ejecutar si la solicitud 
            // es exitosa
            success: function(response) {
                alert('Producto añadido correctamente');
                $('#addProductoForm')[0].reset();
                obtenerProductos();
            },
            // 35. Función a ejecutar si la solicitud 
            // falla
            error: function() {
                alert('Error al añadir producto');
            }
        });
    });

    // 36. Inicializa las listas de categorías y 
    // productos al cargar la página
    obtenerCategorias();
    obtenerProductos();
});
