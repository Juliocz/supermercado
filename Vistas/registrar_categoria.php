<div style="min-width: 300px; width: 300px;">
    <form id="form_registro" action="/registrar_categoria" method="post" onsubmit="return registrar();" style="padding:var(--miniPaddingAndGrap) ;display:grid;grid-gap: var(--miniPaddingAndGrap);">
        <h2>Registrar Categoria</h2>
        <div style="display:grid;grid-template-columns: 1fr 3fr;grid-gap: var(--miniPaddingAndGrap);">

            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" required>

            <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion" style="max-width: 100%;" required>
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
    function registrar() {

        

        //obtengo del formulario
        var categoria = new Object();
        var f = document.querySelector('#form_registro');
        var btn=f.querySelector('#btnenviar');
        btn.disabled=true;

        categoria.nombre = document.querySelector("[name='nombre']").value;
        categoria.descripcion = document.querySelector("[name='descripcion']").value;
        //envio post
        var settings = {
            "url": window.location + "/registrar_categoria",
            "method": "POST",
            "timeout": 0,
            "data": JSON.stringify(categoria),
        };
        //alert(JSON.stringify(categoria));

        console.log("URL: "+window.location + "/registrar_categoria");
        $.ajax(settings).done(function(response) {
            refreshTable();
            //response=JSON.parse(response);
            console.log(response);
            f.querySelector('#msgsucess').innerHTML="REGISTRADO CORRECTAMENTE";
            f.querySelector('#msgsucess').showAnimVertical();
            setInterval(function(){f.querySelector('#msgsucess').hideAnimVertical();},2000);
            btn.disabled=false;
            console.log(response.nombre);
            
            
        }).fail(function() {
            f.querySelector('#msgalert').innerHTML="No se pudo registrar";
            f.querySelector('#msgalert').showAnimVertical();
            setInterval(function(){f.querySelector('#msgalert').hideAnimVertical();},2000);
            btn.disabled=false;

        });;

       return false;
    }
</script>