<div style="min-width: 300px; width: 300px;">
    <form id="form_eliminar" action="/modificar_categoria" method="post" onsubmit="return deleteCategoria();" style="padding:var(--miniPaddingAndGrap) ;display:grid;grid-gap: var(--miniPaddingAndGrap);">
        <h2>Eliminar Categoria</h2>
        <div style="display:grid;grid-template-columns: 1fr 3fr;grid-gap: var(--miniPaddingAndGrap);">
            <input type="text" name="id" style="display:none;" required>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" required>

            <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion" style="max-width: 100%;" required>
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
    function setDeleteCategoriaValues(id, name, descripcion) {

        var f = document.querySelector('#form_eliminar');
        f.querySelector("[name='id']").value = id;
        f.querySelector("[name='nombre']").value = name;
        f.querySelector("[name='descripcion']").value = descripcion;

    }

    function deleteCategoria() {

        //obtengo del formulario
        var categoria = new Object();
        var f = document.querySelector('#form_eliminar');
        var btn = f.querySelector('#btnenviar');
        btn.disabled = true;

        categoria.id = f.querySelector("[name='id']").value;
        categoria.nombre = f.querySelector("[name='nombre']").value;
        categoria.descripcion = f.querySelector("[name='descripcion']").value;
        //envio post
        var settings = {
            "url": window.location + "/eliminar_categoria",
            "method": "POST",
            "timeout": 0,
            "data": JSON.stringify(categoria),
        };

        console.log("URL: " + window.location + "/eliminar_categoria");
        $.ajax(settings).done(function(response) {
            if (response == '1') {
                refreshTable();
                //response=JSON.parse(response);
                console.log(response);
                f.querySelector('#msgsucess').innerHTML = "Eliminado CORRECTAMENTE";
                f.querySelector('#msgsucess').showAnimVertical();
                setInterval(function() {
                    f.querySelector('#msgsucess').hideAnimVertical();
                }, 2000);
                btn.disabled = false;
                console.log(response.nombre);
            } else {
                f.querySelector('#msgalert').innerHTML = "No se pudo eliminar: " + response;
                f.querySelector('#msgalert').showAnimVertical();
                setInterval(function() {
                    f.querySelector('#msgalert').hideAnimVertical();
                }, 2000);
                btn.disabled = false;
            }

        }).fail(function() {
            f.querySelector('#msgalert').innerHTML = "No se pudo eliminar";
            f.querySelector('#msgalert').showAnimVertical();
            setInterval(function() {
                f.querySelector('#msgalert').hideAnimVertical();
            }, 2000);
            btn.disabled = false;

        });;

        return false;
    }
</script>