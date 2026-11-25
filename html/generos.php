<?php
session_start();
$pagina = "generos";
$titulo = "Géneros";
$subtitulo = "Rock, jazz, electrónica y más";
include "includes/encabezado.php";
?>
        <section class="container px-4 px-lg-5">
            <div class="vacio">
                <p>Aquí vas a poder buscar discos por género.</p>
                <a class="btn btn-tienda mt-2" href="catalogo.php">Ver el catálogo</a>
            </div>
        </section>
<?php include "includes/pie.php"; ?>
