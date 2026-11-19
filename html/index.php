<?php
$pagina = "inicio";
$titulo = "Tienda de Discos";
$subtitulo = "Vinilos, CDs y casetes";
include "includes/encabezado.php";
?>
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Novedades</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
<?php
for ($i = 1; $i <= 8; $i++) {
?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <img class="card-img-top" src="https://dummyimage.com/450x450/dee2e6/6c757d.jpg&text=Disco+<?php echo $i; ?>" alt="Disco <?php echo $i; ?>" />
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder">Álbum <?php echo $i; ?></h5>
                                    <p class="text-muted mb-1">Artista</p>
                                    $0.00
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="catalogo.php">Ver disco</a></div>
                            </div>
                        </div>
                    </div>
<?php
}
?>
                </div>
            </div>
        </section>
<?php include "includes/pie.php"; ?>
