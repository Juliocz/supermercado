<div id="containerProductos">

    <div style="display: flex;flex-wrap: wrap;align-items:flex-start; align-content:flex-start; padding: 10px; justify-content: center;">
        <h1 class="center" style="width: 100%;">PRODUCTOS</h1>
        <div style="width: 100%;" class="center">
            <img style="width: 100%; height: 100px;object-fit: cover;" src="res/producto_icon.png" alt="" srcset="">
        </div>
        <?php include_once "registrar_producto.php" ?>
        <?php include_once "modificar_producto.php" ?>
        <?php include_once "eliminar_producto.php" ?>
        <?php include_once "producto_table.php" ?>
    </div>
</div>

<script>
    function showProductos() {
        hideAllCruds();
        document.querySelector('#containerProductos').style.display = '';
    }
</script>