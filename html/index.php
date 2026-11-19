<?php
$pagina = "inicio";
$titulo = "Inicio";
include "includes/encabezado.php";

$discos = array(
    array("Mareas lentas", "Los Faros", "Vinilo", 459),
    array("Sol de mediodía", "Cometa Azul", "Vinilo", 389),
    array("Confeti", "Las Bicicletas", "CD", 249),
    array("Señal débil", "Radio Norte", "Vinilo", 529),
    array("Volcán", "Tierra Fría", "Casete", 199),
    array("Tablero", "Club Ajedrez", "Vinilo", 419),
    array("Después de las 3", "Neón Bajo", "CD", 279),
    array("Cuarto rojo", "Mónica Vela", "Vinilo", 489)
);
?>
        <section class="portada-inicio">
            <div class="container px-4 px-lg-5">
                <div class="row align-items-end">
                    <div class="col-lg-7 pb-5">
                        <h1>Discos para escuchar de principio a fin</h1>
                        <p>Vinilos, CDs y casetes, nuevos y usados.</p>
                        <a class="btn btn-precio btn-lg mt-3 me-2" href="catalogo.php">Ver catálogo</a>
                        <a class="btn btn-tienda btn-lg mt-3" href="generos.php">Buscar por género</a>
                    </div>
                    <div class="col-lg-5">
                        <div class="escaparate funda mb-0">
                            <img class="vinilo" src="img/vinilo.png" alt="" />
                            <img class="portada" src="img/portadas/1.jpg" alt="Portada de Mareas lentas" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="repisa"></div>
        </section>
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-4">
                <h2 class="titulo-seccion">Recién llegados</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">
<?php
for ($i = 0; $i < count($discos); $i++) {
?>
                    <div class="col">
                        <div class="disco">
                            <div class="funda">
                                <img class="vinilo" src="img/vinilo.png" alt="" />
                                <img class="portada" src="img/portadas/<?php echo $i + 1; ?>.jpg" alt="Portada de <?php echo $discos[$i][0]; ?>" />
                                <span class="precio">$<?php echo $discos[$i][3]; ?></span>
                            </div>
                            <h3><?php echo $discos[$i][0]; ?></h3>
                            <p class="artista"><?php echo $discos[$i][1]; ?></p>
                            <p class="formato"><?php echo $discos[$i][2]; ?></p>
                            <a class="btn btn-tienda btn-sm" href="catalogo.php">Ver disco</a>
                        </div>
                    </div>
<?php
}
?>
                </div>
            </div>
        </section>
<?php include "includes/pie.php"; ?>
