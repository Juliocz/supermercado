<div style="min-width: 300px;width: 300px;">
    <form id="form_registrarproducto" enctype="multipart/form-data" action="/registrar_categoria" method="post" onsubmit="return registrarProducto(); " style="padding:var(--miniPaddingAndGrap) ;display:grid;grid-gap: var(--miniPaddingAndGrap);">
        <h2>Registrar Producto</h2>
        <div style="display:grid;grid-template-columns: 1fr 3fr;grid-gap: var(--miniPaddingAndGrap);">

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
        <button id="btnenviar" class="button_success center" style="width:100%;" type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
            Registrar
        </button>
    </form>
</div>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#blah')
                    .attr('src', e.target.result)
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    refreshSelectCategoria();
    //hago peticion, recibo las categorias y asigno al select
    function refreshSelectCategoria() {
        var settings = {
            "url": window.location + "/get_categoria",
            "method": "GET",
            "timeout": 0
        };
        console.log("URL: " + window.location + "/get_categoria");
        $.ajax(settings).done(function(response) {
            setSelectCategoria(response);
        }).fail(function() {
            alert("No se pudo cargar Select Categorias");
        });;
    }
    //asigno array al aselect
    function setSelectCategoria(categorias) {
        var f = document.querySelector('#form_registrarproducto');
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

    function registrarProducto() {



        //obtengo del formulario
        var categoria = new Object();
        var f = document.querySelector('#form_registrarproducto');
        var btn = f.querySelector('#btnenviar');
        btn.disabled = true;

        categoria.nombre = f.querySelector("[name='nombre']").value;
        categoria.precio = f.querySelector("[name='precio']").value;
        categoria.id_categoria = f.querySelector("[name='id_categoria']").value;
        categoria.url_image = f.querySelector("[name='imagen']").value;

        //  var formData = new FormData();
        // formData.append('file',f.querySelector("[name='imagen']").files[0]);
        //  categoria.imagen=formData
        // alert(categoria.imagen);
        //envio post
        var settings = {
            "url": window.location + "/registrar_producto",
            "method": "POST",
            "timeout": 0,
            "data": JSON.stringify(categoria),
        };
        //alert(JSON.stringify(categoria));

        console.log("URL: " + window.location + "/registrar_producto");
        $.ajax(settings).done(function(response) {
            //alert("done")
            // refreshTable();
            //response=JSON.parse(response);

            console.log(response);
            if (response == '1') {
                refreshTableProducto();
                f.querySelector('#msgsucess').innerHTML = "REGISTRADO CORRECTAMENTE";
                f.querySelector('#msgsucess').showAnimVertical();
                setInterval(function() {
                    f.querySelector('#msgsucess').hideAnimVertical();
                }, 2000);
            } else {
                f.querySelector('#msgalert').innerHTML = "Enviado pero no registrado.";
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
            f.querySelector('#msgalert').innerHTML = "No se pudo registrar";
            f.querySelector('#msgalert').showAnimVertical();
            setInterval(function() {f.querySelector('#msgalert').hideAnimVertical();}, 2000);
            }
            btn.disabled = false;
        });;

        return false;
    }
</script>