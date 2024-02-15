$(document).ready(function() {
    // Función para obtener y mostrar la lista de categorías
    function obtenerCategorias() {
        $.ajax({
            url: 'http://localhost/PERSONAL_WebServicePostman/controller/categoria_controller.php?op=GetAll',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                let htmlCategorias = '';
                response.forEach(categoria => {
                    htmlCategorias += 
                    `<li>
                        ${categoria.cat_nom} - ${categoria.cat_obs}
                        <br>
                        <button class="boton_editar" onclick="mostrarEditarCategoria(${categoria.cat_id}, '${categoria.cat_nom}', '${categoria.cat_obs}')">Editar</button>
                        <button class="boton_eliminar" onclick="eliminarCategoria(${categoria.cat_id})">Eliminar</button>
                    </li>
                    <div class="linea_horizontal3"></div>`;
                });
                $('#listaCategorias').html(htmlCategorias);
            },
            error: function() {
                alert('Error al obtener categorías');
            }
        });
    }

    // Función para obtener y mostrar la lista de productos
    function obtenerProductos() {
        $.ajax({
            url: 'http://localhost/PERSONAL_WebServicePostman/controller/categoria_controller.php?op=GetAllProductos',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                let htmlProductos = '';
                response.forEach(producto => {
                    htmlProductos += 
                    `<li>
                        ${producto.prod_nom} - ${producto.prod_desc} - ${producto.prod_precio}
                        <br>
                        <button class="boton_editar" onclick="mostrarEditarProducto(${producto.prod_id}, ${producto.cat_id}, '${producto.prod_nom}', '${producto.prod_desc}', ${producto.prod_precio})">Editar</button>
                        <button class="boton_eliminar" onclick="eliminarProducto(${producto.prod_id})">Eliminar</button>
                    </li>
                    <div class="linea_horizontal3"></div>`;
                });
                $('#listaProductos').html(htmlProductos);
            },
            error: function() {
                alert('Error al obtener productos');
            }
        });
    }

    // Mostrar formulario de edición para categoría
    window.mostrarEditarCategoria = function(cat_id, cat_nom, cat_obs) {
        $('#edit_cat_id').val(cat_id);
        $('#edit_cat_nom').val(cat_nom);
        $('#edit_cat_obs').val(cat_obs);
        $('#editCategoriaForm').show();
    };

    // Mostrar formulario de edición para producto
    window.mostrarEditarProducto = function(prod_id, cat_id, prod_nom, prod_desc, prod_precio) {
        $('#edit_prod_id').val(prod_id);
        $('#edit_prod_cat_id').val(cat_id);
        $('#edit_prod_nom').val(prod_nom);
        $('#edit_prod_desc').val(prod_desc);
        $('#edit_prod_precio').val(prod_precio);
        $('#editProductoForm').show();
    };

    // Guardar cambios de la categoría editada
    window.submitEditCategoria = function() {
        var cat_id = $('#edit_cat_id').val();
        var cat_nom = $('#edit_cat_nom').val();
        var cat_obs = $('#edit_cat_obs').val();

        $.ajax({
            url: 'http://localhost/PERSONAL_WebServicePostman/controller/categoria_controller.php?op=Update',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ cat_id, cat_nom, cat_obs }),
            success: function(response) {
                alert('Categoría actualizada correctamente');
                obtenerCategorias();
                $('#editCategoriaForm').hide();
            },
            error: function() {
                alert('Error al actualizar categoría');
            }
        });
    };

    // Guardar cambios del producto editado
    window.submitEditProducto = function() {
        var prod_id = $('#edit_prod_id').val();
        var cat_id = $('#edit_prod_cat_id').val();
        var prod_nom = $('#edit_prod_nom').val();
        var prod_desc = $('#edit_prod_desc').val();
        var prod_precio = $('#edit_prod_precio').val();

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

    // Eliminar categoría
    window.eliminarCategoria = function(cat_id) {
        if(confirm("¿Estás seguro de querer eliminar esta categoría?")) {
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

    // Eliminar producto
    window.eliminarProducto = function(prod_id) {
        if(confirm("¿Estás seguro de querer eliminar este producto?")) {
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

    // Añadir nueva categoría
    $('#addCategoriaForm').submit(function(e) {
        e.preventDefault();
        var cat_nom = $('#cat_nom').val();
        var cat_obs = $('#cat_obs').val();
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

    // Añadir nuevo producto
    $('#addProductoForm').submit(function(e) {
        e.preventDefault();
        var cat_id = $('#prod_cat_id').val();
        var prod_nom = $('#prod_nom').val();
        var prod_desc = $('#prod_desc').val();
        var prod_precio = $('#prod_precio').val();
        $.ajax({
            url: 'http://localhost/PERSONAL_WebServicePostman/controller/categoria_controller.php?op=InsertProducto',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ cat_id, prod_nom, prod_desc, prod_precio }),
            success: function(response) {
                alert('Producto añadido correctamente');
                $('#addProductoForm')[0].reset();
                obtenerProductos();
            },
            error: function() {
                alert('Error al añadir producto');
            }
        });
    });

    // Inicializar listas al cargar la página
    obtenerCategorias();
    obtenerProductos();
});
