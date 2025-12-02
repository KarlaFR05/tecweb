// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

$(document).ready(function () {
    let edit = false;

    let JsonString = JSON.stringify(baseJSON, null, 2);
    $('#description').val(JsonString);
    $('#product-result').hide();
    listarProductos();

    function listarProductos() {
        $.ajax({
            url: './backend/products',
            type: 'GET',
            success: function (response) {
                const productos = typeof response === 'string' ? JSON.parse(response) : response;

                if (Array.isArray(productos) && productos.length > 0) {
                    let template = '';
                    productos.forEach(producto => {
                        let descripcion = '';
                        descripcion += '<li>precio: ' + producto.precio + '</li>';
                        descripcion += '<li>unidades: ' + producto.unidades + '</li>';
                        descripcion += '<li>modelo: ' + producto.modelo + '</li>';
                        descripcion += '<li>marca: ' + producto.marca + '</li>';
                        descripcion += '<li>detalles: ' + producto.detalles + '</li>';

                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger">Eliminar</button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#products').html(template);
                } else {
                    $('#products').html('<tr><td colspan="4">No hay productos disponibles</td></tr>');
                }
            },
            error: function () {
                $('#products').html('<tr><td colspan="4">Error al cargar productos</td></tr>');
            }
        });
    }

    $('#search').keyup(function () {
        const query = $('#search').val().trim();
        if (query) {
            $.ajax({
                url: './backend/products/search/' + encodeURIComponent(query),
                type: 'GET',
                success: function (response) {
                    const productos = typeof response === 'string' ? JSON.parse(response) : response;
                    if (Array.isArray(productos) && productos.length > 0) {
                        let template = '';
                        let template_bar = '';
                        productos.forEach(producto => {
                            let descripcion = '';
                            descripcion += '<li>precio: ' + producto.precio + '</li>';
                            descripcion += '<li>unidades: ' + producto.unidades + '</li>';
                            descripcion += '<li>modelo: ' + producto.modelo + '</li>';
                            descripcion += '<li>marca: ' + producto.marca + '</li>';
                            descripcion += '<li>detalles: ' + producto.detalles + '</li>';

                            template += `
                                <tr productId="${producto.id}">
                                    <td>${producto.id}</td>
                                    <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                    <td><ul>${descripcion}</ul></td>
                                    <td><button class="product-delete btn btn-danger">Eliminar</button></td>
                                </tr>
                            `;
                            template_bar += `<li>${producto.nombre}</li>`;
                        });
                        $('#product-result').show();
                        $('#container').html(template_bar);
                        $('#products').html(template);
                    } else {
                        $('#product-result').show();
                        $('#container').html('<li>No se encontraron resultados</li>');
                        $('#products').html('<tr><td colspan="4">No se encontraron productos</td></tr>');
                    }
                }
            });
        } else {
            $('#product-result').hide();
            listarProductos();
        }
    });

    $('#product-form').submit(function (e) {
        e.preventDefault();

        const nombre = $('#name').val().trim();
        if (!nombre) {
            alert('El nombre del producto es obligatorio.');
            return;
        }

        try {
            let postData = JSON.parse($('#description').val());
            postData.nombre = nombre;

            const url = edit === false ? './backend/products' : './backend/products/' + $('#productId').val();
            const method = edit === false ? 'POST' : 'PUT';

            $.ajax({
                url: url,
                type: method,
                contentType: 'application/json; charset=utf-8',
                data: JSON.stringify(postData), // ✅ CORREGIDO: faltaba "data:"
                success: function (response) {
                    let respuesta = typeof response === 'string' ? JSON.parse(response) : response;
                    let template_bar = `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
                    $('#product-result').show();
                    $('#container').html(template_bar);
                    $('#name').val('');
                    $('#description').val(JsonString);
                    $('#productId').val('');
                    listarProductos();
                    edit = false;
                },
                error: function (xhr) {
                    alert('Error al procesar la solicitud. Revisa la consola.');
                    console.error(xhr.responseText);
                }
            });
        } catch (err) {
            alert('Error: El campo "Descripción" debe contener un JSON válido.');
            console.error(err);
        }
    });

    $(document).on('click', '.product-delete', function (e) {
        if (confirm('¿Realmente deseas eliminar el producto?')) {
            const row = $(e.target).closest('tr');
            const id = row.attr('productId');
            $.ajax({
                url: './backend/products/' + id,
                type: 'DELETE',
                success: function () {
                    $('#product-result').hide();
                    listarProductos();
                },
                error: function () {
                    alert('Error al eliminar el producto.');
                }
            });
        }
    });

    $(document).on('click', '.product-item', function (e) {
        e.preventDefault();
        const row = $(e.target).closest('tr');
        const id = row.attr('productId');
        $.ajax({
            url: './backend/products/' + id,
            type: 'GET',
            success: function (response) {
                let product = typeof response === 'string' ? JSON.parse(response) : response;
                $('#name').val(product.nombre);
                $('#productId').val(product.id);
                delete product.nombre;
                delete product.id;
                delete product.eliminado;
                $('#description').val(JSON.stringify(product, null, 2));
                edit = true;
            },
            error: function () {
                alert('Error al cargar los datos del producto.');
            }
        });
    });
});