<div style="min-width: 300px;width: 300px;">
    <form id="form_eliminarproducto" action="/mo" method="post" onsubmit="return eliminarProducto() " style="padding:var(--miniPaddingAndGrap) ;display:grid;grid-gap: var(--miniPaddingAndGrap);">
        <h2>Eliminar Producto</h2>
        <div style="display:grid;grid-template-columns: 1fr 3fr;grid-gap: var(--miniPaddingAndGrap);">


            <input type="text" name="id" style="display:none;" required>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" required>


            <label for="Precio">Precio</label>
            <input type="number" name="precio" style="max-width: 100%;" required>


            <input type="text" name="imagen" style="display:none;max-width: 100%;">
            <!-- <label>Imagen</label>
            <div style="display:grid;">
                <input type="file" name="imagen" style="max-width: 100%;" onchange="readURL(this);">
                <img id="blah" src="#" alt="" style="width: 300px; object-fit: cover;" />
            </div> -->

            <label for="categoriaselect">Categoria</label>
            <select name="id_categoria" id="categoriaselect" required>
                <option value="">Elejir categoria:</option>
            </select>
        </div>
        <div id="msgalert" class="message_alert alert center" des_visible="false">MENSAJE</div>
        <div id="msgsucess" class="message_alert sucess center" des_visible="false">MENSAJE</div>
        <button id="btnenviar" class="button_danger center" style="width:100%;" type="submit">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
            </svg>
            Eliminar
        </button>
    </form>
</div>
<script>
 function setEliminarProductoValues( name,precio,id_categoria,id,url_image) {
var f = document.querySelector('#form_eliminarproducto');
f.querySelector("[name='id']").value = id;
f.querySelector("[name='nombre']").value = name;
f.querySelector("[name='precio']").value = precio;
f.querySelector("[name='id_categoria']").value = id_categoria;

}

    //hago peticion, recibo las categorias y asigno al select
    function refreshSelectProductoEliminar() {
        var settings = {
            "url": window.location + "/get_categoria",
            "method": "GET",
            "timeout": 0
        };
        console.log("URL: " + window.location + "/get_categoria");
        $.ajax(settings).done(function(response) {
            setSelectCategoriaEliminar(response);
        }).fail(function() {
            alert("No se pudo cargar Select Categorias");
        });;
    }
    //asigno array al aselect
    function setSelectCategoriaEliminar(categorias) {
        var f = document.querySelector('#form_eliminarproducto');
        var select = f.querySelector("[name='id_categoria']");
        var header = select.children[0];
        select.innerHTML = "";
        select.appendChild(header);
        for (var obj of categorias) {
            var option = header.cloneNode(true);
            option.value = obj.id;
            option.innerHTML = obj.nombre;

            select.appendChild(option);
        }
    }
    refreshSelectProductoEliminar();




    function eliminarProducto() {



        //obtengo del formulario
        var item = new Object();
        var f = document.querySelector('#form_eliminarproducto');
        var btn = f.querySelector('#btnenviar');
        btn.disabled = true;

        item.nombre = f.querySelector("[name='nombre']").value;
        item.precio = f.querySelector("[name='precio']").value;
        item.id_categoria = f.querySelector("[name='id_categoria']").value;
        item.id = f.querySelector("[name='id']").value;
        item.url_image = f.querySelector("[name='imagen']").value;

        var settings = {
            "url": window.location + "/eliminar_producto",
            "method": "POST",
            "timeout": 0,
            "data": JSON.stringify(item),
        };

        console.log("URL: " + window.location + "/eliminar_producto");
        $.ajax(settings).done(function(response) {

            console.log(response);
            if (response == '1') {
                refreshTableProducto();
                f.querySelector('#msgsucess').innerHTML = "ELIMINADO CORRECTAMENTE";
                f.querySelector('#msgsucess').showAnimVertical();
                setInterval(function() {
                    f.querySelector('#msgsucess').hideAnimVertical();
                }, 2000);
            } else {
                f.querySelector('#msgalert').innerHTML = "Enviado pero no eliminado.";
                f.querySelector('#msgalert').showAnimVertical();
                setInterval(function() {
                    f.querySelector('#msgalert').hideAnimVertical();
                }, 2000);
            }
            btn.disabled = false;

        }).fail(function(jqXHR, textStatus, errorThrown)
        {   console.log(jqXHR.responseText);
            if(jqXHR.responseText=='2'){
                f.querySelector('#msgalert').innerHTML = "El producto ya existe.";
            f.querySelector('#msgalert').showAnimVertical();
            setInterval(function() {f.querySelector('#msgalert').hideAnimVertical();}, 2000)
            }else{
            f.querySelector('#msgalert').innerHTML = "No se pudo modificar";
            f.querySelector('#msgalert').showAnimVertical();
            setInterval(function() {f.querySelector('#msgalert').hideAnimVertical();}, 2000);
            }
            btn.disabled = false;
        });;

        return false;
    }
</script>