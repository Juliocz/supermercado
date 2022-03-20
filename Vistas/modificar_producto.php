<div style="min-width: 300px;width: 300px;">
    <form id="form_modificarproducto" action="/mo" method="post" onsubmit="return modificarProducto() " style="padding:var(--miniPaddingAndGrap) ;display:grid;grid-gap: var(--miniPaddingAndGrap);">
        <h2>Registrar Producto</h2>
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
        <button id="btnenviar" class="button_alert center" style="width:100%;" type="submit">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
            </svg>
            Modificar
        </button>
    </form>
</div>
<script>
 function setModificarProductoValues( name,precio,id_categoria,id,url_image) {
var f = document.querySelector('#form_modificarproducto');
f.querySelector("[name='id']").value = id;
f.querySelector("[name='nombre']").value = name;
f.querySelector("[name='precio']").value = precio;
f.querySelector("[name='id_categoria']").value = id_categoria;

}

    //hago peticion, recibo las categorias y asigno al select
    function refreshSelectCategoriaModificar() {
        var settings = {
            "url": window.location + "/get_categoria",
            "method": "GET",
            "timeout": 0
        };
        console.log("URL: " + window.location + "/get_categoria");
        $.ajax(settings).done(function(response) {
            setSelectCategoriaModificar(response);
        }).fail(function() {
            alert("No se pudo cargar Select Categorias");
        });;
    }
    //asigno array al aselect
    function setSelectCategoriaModificar(categorias) {
        var f = document.querySelector('#form_modificarproducto');
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
    refreshSelectCategoriaModificar();




    function modificarProducto() {



        //obtengo del formulario
        var item = new Object();
        var f = document.querySelector('#form_modificarproducto');
        var btn = f.querySelector('#btnenviar');
        btn.disabled = true;

        item.nombre = f.querySelector("[name='nombre']").value;
        item.precio = f.querySelector("[name='precio']").value;
        item.id_categoria = f.querySelector("[name='id_categoria']").value;
        item.id = f.querySelector("[name='id']").value;
        item.url_image = f.querySelector("[name='imagen']").value;

        var settings = {
            "url": window.location + "/modificar_producto",
            "method": "POST",
            "timeout": 0,
            "data": JSON.stringify(item),
        };

        console.log("URL: " + window.location + "/modificar_producto");
        $.ajax(settings).done(function(response) {

            console.log(response);
            if (response == '1') {
                refreshTableProducto();
                f.querySelector('#msgsucess').innerHTML = "MODIFICADO CORRECTAMENTE";
                f.querySelector('#msgsucess').showAnimVertical();
                setInterval(function() {
                    f.querySelector('#msgsucess').hideAnimVertical();
                }, 2000);
            } else {
                f.querySelector('#msgalert').innerHTML = "Enviado pero no modificado.";
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