<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/root.css" rel="stylesheet" type="text/css" />
    <link href="css/myfront.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<style>
    .botonnav {
        background-color: var(--colorThemeBg2);
        width: 50px;
        height: 50px;
        position: absolute;
        z-index: 2;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        left: 5px;
        top: 5px;
        box-shadow: 2px 3px 10px var(--colorThemeBg1Shadow);
    }

    .botonnav:hover {
        background-color: var(--colorThemeBg3Light);
    }

    /*item nav*/

    /*subitemnav*/
</style>

<body>
    <!-- botonMostrarNav -->
    <div class="navshowbotton botonnav" id="navshow" navid_show="nav">
        <svg style="color: var(--colorThemeDanger)" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
        </svg>
    </div>
    <!-- botonMostrarNavFin -->

    <!-- ContenidoYNAV -->
    <div class="navcontainer">
        <!-- NAV VERTICAL -->
        <div class="nav" id="nav" botonid_show="navshow">
            <!-- icono y descripcion -->
            <div style="height: 100px; display: flex; justify-content: center;align-items: center;">
                <svg style="color:var(--colorThemeDanger);" xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                    <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z" />
                </svg>
            </div>
            <h4 class="center">Bienvenido al administrador del supermercado</h4>
            <!-- icono y descripcion FIN-->
            <div>

                <div class="menu_vertical">
                    <div class="menu_vertical_click" des_visible="false">
                        <div class="itemnav" onclick="showCategorias()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                            </svg>
                            <h5 class="centerV">Categorias</h5>
                        </div>
                    </div>
                    <div class="des_vertical" style="padding-left: 20px;">


                        <div class="menu_vertical_click" des_visible="true">
                            <div class="itemnav">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-archive-fill" viewBox="0 0 16 16">
                                    <path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z" />
                                </svg>
                                <h5 class="centerV">Frutas</h5>
                            </div>
                        </div>
                        <div class="menu_vertical_click" des_visible="true">
                            <div class="itemnav">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-archive-fill" viewBox="0 0 16 16">
                                    <path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z" />
                                </svg>
                                <h5 class="centerV">Carne</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="itemnav" onclick="showProductos()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                        <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                    </svg>
                    <h5 class="centerV">Productos</h5>
                </div>
            </div>
        </div>
        <!-- NAV VERTICAL FIN-->

        <!-- Contenido -->
        <div class="contenido">
            <div id="cruds">
                <?php include_once "crud_categoria.php";?>
                <?php include_once "crud_productos.php";?>
            </div>
        </div>
        <!-- Contenido FIN-->
    </div>
</body>

<script src="js/myfront.js"></script>

</html>