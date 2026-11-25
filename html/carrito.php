<?php
session_start();
$pagina = "carrito";
$titulo = "Carrito";
$subtitulo = "Los discos que vas a comprar";
include "includes/encabezado.php";
?>
        <section class="container px-4 px-lg-5">
            <div class="vacio">
                <p>Tu carrito está vacío. Agrega discos desde el catálogo.</p>
                <a class="btn btn-tienda mt-2" href="catalogo.php">Ir al catálogo</a>
            </div>
        </section>
<?php include "includes/pie.php"; ?>
