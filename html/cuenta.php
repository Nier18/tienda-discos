<?php
session_start();
$pagina = "cuenta";
$titulo = "Iniciar sesión";
$subtitulo = "Entra a tu cuenta o crea una";
include "includes/encabezado.php";
?>
        <section class="container px-4 px-lg-5">
            <div class="vacio">
                <p>Aquí vas a poder iniciar sesión o registrarte para comprar.</p>
                <a class="btn btn-tienda mt-2" href="index.php">Volver al inicio</a>
            </div>
        </section>
<?php include "includes/pie.php"; ?>
