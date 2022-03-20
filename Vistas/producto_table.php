<div style="width: 100%;">
<div style="display: grid;width: 300px; grid-template-columns: auto 1fr;">
    <label for="">BUSCAR</label>
    <input type="text" id="search_producto_input">
    </div>
    <table id="table_producto" class="t_table" style="width: 100%;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">nombre</th>
                <th scope="col">precio</th>
                <th scope="col">id</th>
                <th scope="col">id_categoria</th>
                <th scope="col">accion</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <tr id="itembase">
            <td name="index" scope="row">1</td>
            <td name="nombre">Mark</td>
            <td name="precio">Otto</td>
            <td name="id">@mdo</td>
            <td name="id_categoria">Otto</td>
            <td style="display: flex;">
                <div class="button_success" style="padding:5px;width: 16px;" onclick="chargueToFormProductMod(getItemFromRowProduct(this.parentNode.parentNode));">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                    </svg>
                </div>
                <div class="button_danger" style="padding:5px;width: 16px;" onclick="chargueToFormProductDelete(getItemFromRowProduct(this.parentNode.parentNode))">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                    </svg>
                </div>
            </td>
        </tr>
    </table>
</div>

<script>
    var table_product = document.querySelector('#table_producto');
    var itembase_product = table_product.querySelector('#itembase');
    itembase_product.parentNode.removeChild(itembase_product);


    refreshTableProducto();
    //vacio tabla
    function setTableProductItems(items){
        clearTableProduct();
            var loop = 0;
            for (var item of items) {
                insertItemToTableProduct(createRowProductFromBase(loop, item.nombre, item.precio,item.id_categoria, item.id));
                loop++;
            }
    }
    function clearTableProduct() {
        table_product.querySelector("tbody").innerHTML = "";
    }
    //inserto item a la tabla
    function insertItemToTableProduct(row) {
        table_product.querySelector("tbody").appendChild(row);
    }
       //obtengo objeto del elemento row
       function getItemFromRowProduct(row) {
        var item = new Object();
        item.index = row.querySelector("[name='index']").innerHTML;
        item.nombre = row.querySelector("[name='nombre']").innerHTML;
        item.precio = row.querySelector("[name='precio']").innerHTML;
        item.id_categoria = row.querySelector("[name='id_categoria']").innerHTML;
        item.id = row.querySelector("[name='id']").innerHTML;
        item_url_image="na";
        return item;
    }

    //cargo el objeto obtenido del row al formulario modificar
    function chargueToFormProductMod(obj) {
        setModificarProductoValues(obj.nombre, obj.precio, obj.id_categoria,obj.id,obj.url_image);
    }
    function chargueToFormProductDelete(obj){
        setEliminarProductoValues(obj.nombre, obj.precio, obj.id_categoria,obj.id,obj.url_image);
    }
    function createRowProductFromBase(index, name, precio,id_categoria, id) {
        var item = itembase_product.cloneNode(true);
        item.querySelector("[name='index']").innerHTML = index;
        item.querySelector("[name='nombre']").innerHTML = name;
        item.querySelector("[name='precio']").innerHTML = precio;
        item.querySelector("[name='id_categoria']").innerHTML = id_categoria;
        item.querySelector("[name='id']").innerHTML = id;
        return item;
    }

    function refreshTableProducto() {

        var settings = {
            "url": window.location + "/get_producto",
            "method": "GET",
            "timeout": 0
        };
        console.log("URL: " + window.location + "/get_producto");
        $.ajax(settings).done(function(response) {
            setTableProductItems(response);
            console.log(response);
            /*clearTable();
            var loop = 0;
            for (var categoria of response) {
                insertItemToTable(createItemFromBase(loop, categoria.nombre, categoria.descripcion, categoria.id))
                loop++;
            }*/
        }).fail(function(jqXHR, textStatus, errorThrown) {
          //  console.log(jqXHR.responseText);
            alert('no se pudo cargar la tabla productos');
        });;
    }


     //buscar tabla

     $(document).ready(function() {
            $("#search_producto_input").keyup(function() {
                _this = this;
                // Show only matching TR, hide rest of them
                $.each($("#table_producto tbody tr"), function() {
                    if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                        $(this).hide();
                    else
                        $(this).show();
                });
            });
        });
</script>