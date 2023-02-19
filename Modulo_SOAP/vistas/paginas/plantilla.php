<?php 
    session_name("MODULO_MOAL");
    session_start();
    include("./vistas/paginas/head.php");
?>
<body>
    <header>
        <a href="./index.php">
            <img class = "imagenLogo" src = "./vistas/imagenes/php-logo.jpg" alt = "Logo Sitio" >
        </a>
        <nav id = "menuPrincipal">
            <ul id = "listamenu" >
                <li><a href="./index.php?ruta=inicio" >Inicio</a></li>
                <li><a href="./index.php?ruta=registro" >Registro</a></li>
                <li><a href="./index.php?ruta=listadetallada" >Lista Detallada</a></li>
                <li><a href="./index.php?ruta=testSOAP" >Test SOAP</a></li>
                <li><a href="./index.php?ruta=HTTP_cURL" >Test cURL_SOAP</a></li>
                <li><a href="./index.php?ruta=HTTP_Request2" >Test HTTP_Request2</a></li>
                <li><a href="./index.php?ruta=salir" >Salir</a></li>
            </ul>
        </nav>
    </header>
    <main> 
        <section >
            <?php
                if ( isset( $_GET['ruta'] ) ) {
                    switch ( $_GET['ruta'] ) {
                        case "inicio":
                        case "registro":
                        case "listadetallada":
                        case "testSOAP":
                        case "HTTP_cURL":
                        case "HTTP_Request2":
                        case "salir":
                            include "./vistas/paginas/" .  $_GET['ruta'] . ".php";
                            break;
                        default:
                            include "paginas/e404.php";
                    }
                }
                else {
                    "paginas/registro.php";
                }
            ?>
        </section>
    </main>
    <?php 
        include("./vistas/paginas/footer.php");
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="vistas/js/script.js"></script>
</body>
</html>