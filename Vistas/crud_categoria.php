<div id="containerCategoria">
    <div style="display: flex;flex-wrap: wrap;align-items:flex-start;
                align-content:flex-start; padding: 10px; justify-content: center;">
        <h1 class="center" style="width: 100%;">CATEGORIAS</h1>
        <div style="width: 100%;" class="center">
            <img style="width: 100%; height: 100px;object-fit: cover;" src="res/categoria_icon.jpg" alt="" srcset="">
        </div>
        <?php include_once "registrar_categoria.php" ?>
        <?php include_once "modificar_categoria.php" ?>
        <?php include_once "eliminar_categoria.php" ?>
        <?php include_once "categoria_table.php" ?>
    </div>
</div>
<script>
    function showCategorias() {
        hideAllCruds();
        //document.querySelector('#containerProductos').style.display='none';
        document.querySelector('#containerCategoria').style.display = '';
    }

    function hideAllCruds() {
        var crudcontainer = document.querySelector('#cruds').children;
        for (var cru of crudcontainer) {
            cru.style.display = 'none';
        }
    }
</script>