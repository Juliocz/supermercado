<div style="width: 100%;">
    <div style="display: grid;width: 300px; grid-template-columns: auto 1fr;">
    <label for="">BUSCAR</label>
    <input type="text" id="search_categoria_input">
    </div>
    <table id="table_categoria" class="t_table" style="width: 100%;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">nombre</th>
                <th scope="col">descripcion</th>
                <th scope="col">id</th>
                <th scope="col">accion</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <tr id="itembase">
            <td name="index" scope="row">1</td>
            <td name="nombre">Mark</td>
            <td name="descripcion">Otto</td>
            <td name="id">@mdo</td>
            <td style="display: flex;">
                <div class="button_success" style="padding:5px;width: 16px;" onclick="chargueToFormMod(getItemFromRow(this.parentNode.parentNode));">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                    </svg>
                </div>
                <div class="button_danger" style="padding:5px;width: 16px;" onclick="chargueToFormDelete(getItemFromRow(this.parentNode.parentNode))">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                    </svg>
                </div>
            </td>
        </tr>
    </table>
</div>

<script>
    var table = document.querySelector('#table_categoria');
    var itembase = table.querySelector('#itembase');
    itembase.parentNode.removeChild(itembase);


    refreshTable();

    function clearTable() {
        table.querySelector("tbody").innerHTML = "";
    }

    function insertItemToTable(item) {
        table.querySelector("tbody").appendChild(item);
    }

    //cargo el objeto obtenido del row al formulario modificar
    function chargueToFormMod(obj) {
        setModificarCategoriaValues(obj.id, obj.nombre, obj.descripcion);
    }
    function chargueToFormDelete(obj){
        setDeleteCategoriaValues(obj.id, obj.nombre, obj.descripcion);
    }

    //obtengo objeto del elemento row
    function getItemFromRow(row) {
        var item = new Object();
        item.index = row.querySelector("[name='index']").innerHTML;
        item.nombre = row.querySelector("[name='nombre']").innerHTML;
        item.descripcion = row.querySelector("[name='descripcion']").innerHTML;
        item.id = row.querySelector("[name='id']").innerHTML;
        return item;
    }

    function createItemFromBase(index, name, descripcion, id) {
        var item = itembase.cloneNode(true);
        item.querySelector("[name='index']").innerHTML = index;
        item.querySelector("[name='nombre']").innerHTML = name;
        item.querySelector("[name='descripcion']").innerHTML = descripcion;
        item.querySelector("[name='id']").innerHTML = id;
        return item;
    }

    function refreshTable() {

        var settings = {
            "url": window.location + "/get_categoria",
            "method": "GET",
            "timeout": 0
        };
        console.log("URL: " + window.location + "/get_categoria");
        $.ajax(settings).done(function(response) {
            clearTable();

            try{//metodos que se definen despues
            refreshSelectCategoriaModificar();//refresco categorias forms productos
            refreshSelectCategoria();
            refreshSelectProductoEliminar();
            }catch(ex){}

            var loop = 0;
            for (var categoria of response) {
                insertItemToTable(createItemFromBase(loop, categoria.nombre, categoria.descripcion, categoria.id))
                loop++;
            }
            //alert(response);
            //response=JSON.parse(response);
            /*console.log(response);
            f.querySelector('#msgsucess').innerHTML="REGISTRADO CORRECTAMENTE";
            f.querySelector('#msgsucess').showAnimVertical();
            setInterval(function(){f.querySelector('#msgsucess').hideAnimVertical();},2000);
            btn.disabled=false;
            console.log(response.nombre);*/
        }).fail(function() {
            /*f.querySelector('#msgalert').innerHTML="No se pudo registrar";
            f.querySelector('#msgalert').showAnimVertical();
            setInterval(function(){f.querySelector('#msgalert').hideAnimVertical();},2000);
            btn.disabled=false;*/

        });;
    }


    //buscar tabla

    $(document).ready(function() {
            $("#search_categoria_input").keyup(function() {
                _this = this;
                // Show only matching TR, hide rest of them
                $.each($("#table_categoria tbody tr"), function() {
                    if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                        $(this).hide();
                    else
                        $(this).show();
                });
            });
        });
</script>