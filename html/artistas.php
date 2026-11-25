<?php
session_start();
$pagina = "artistas";
$titulo = "Artistas";
$subtitulo = "Busca discos por artista";
include "includes/encabezado.php";
?>
        <section class="container px-4 px-lg-5">
            <div class="vacio">
                <p>Aquí vas a ver la lista de artistas y sus discos.</p>
                <a class="btn btn-tienda mt-2" href="catalogo.php">Ver el catálogo</a>
            </div>
        </section>
<?php include "includes/pie.php"; ?>
