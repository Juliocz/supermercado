<div style="min-width: 300px; width: 300px;">
    <form id="form_modificar" action="/modificar_categoria" method="post" onsubmit="return modificar();" style="padding:var(--miniPaddingAndGrap) ;display:grid;grid-gap: var(--miniPaddingAndGrap);">
        <h2>Modificar Categoria</h2>
        <div style="display:grid;grid-template-columns: 1fr 3fr;grid-gap: var(--miniPaddingAndGrap);">
            <input type="text" name="id" style="display:none;" required>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" required>

            <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion" style="max-width: 100%;" required>
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
    function setModificarCategoriaValues(id, name, descripcion) {

        var f = document.querySelector('#form_modificar');
        f.querySelector("[name='id']").value = id;
        f.querySelector("[name='nombre']").value = name;
        f.querySelector("[name='descripcion']").value = descripcion;

    }

    function modificar() {

        //obtengo del formulario
        var categoria = new Object();
        var f = document.querySelector('#form_modificar');
        var btn = f.querySelector('#btnenviar');
        btn.disabled = true;

        categoria.id = f.querySelector("[name='id']").value;
        categoria.nombre = f.querySelector("[name='nombre']").value;
        categoria.descripcion = f.querySelector("[name='descripcion']").value;
        //envio post
        var settings = {
            "url": window.location + "/modificar_categoria",
            "method": "POST",
            "timeout": 0,
            "data": JSON.stringify(categoria),
        };

        console.log("URL: " + window.location + "/modificar_categoria");
        $.ajax(settings).done(function(response) {
            refreshTable();
            //response=JSON.parse(response);
            console.log(response);
            f.querySelector('#msgsucess').innerHTML = "MODIFICADO CORRECTAMENTE";
            f.querySelector('#msgsucess').showAnimVertical();
            setInterval(function() {
                f.querySelector('#msgsucess').hideAnimVertical();
            }, 2000);
            btn.disabled = false;
            console.log(response.nombre);


        }).fail(function() {
            f.querySelector('#msgalert').innerHTML = "No se pudo modificar";
            f.querySelector('#msgalert').showAnimVertical();
            setInterval(function() {
                f.querySelector('#msgalert').hideAnimVertical();
            }, 2000);
            btn.disabled = false;

        });;

        return false;
    }
</script>