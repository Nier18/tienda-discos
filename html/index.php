<?php
session_start();
$pagina = "inicio";
$titulo = "Inicio";
include "includes/encabezado.php";

include "includes/conexion.php";

$sql = "SELECT a.id, a.titulo, a.portada, ar.nombre AS artista,
        MIN(e.precio) AS precio,
        GROUP_CONCAT(e.formato ORDER BY e.formato SEPARATOR ' · ') AS formatos
    FROM albumes a
    JOIN artistas ar ON ar.id = a.artista_id
    JOIN ediciones e ON e.album_id = a.id
    GROUP BY a.id
    ORDER BY a.id
    LIMIT 8;";
$resultado = mysqli_query($con, $sql);
$discos = array();
while ($row = mysqli_fetch_array($resultado)) {
    $discos[] = $row;
}
mysqli_close($con);
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
                            <img class="portada" src="img/discos/<?php echo $discos[0]["portada"]; ?>" alt="Portada de <?php echo htmlspecialchars($discos[0]["titulo"]); ?>" />
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
                                <img class="portada" src="img/discos/<?php echo $discos[$i]["portada"]; ?>" alt="Portada de <?php echo htmlspecialchars($discos[$i]["titulo"]); ?>" />
                                <span class="precio">$<?php echo number_format($discos[$i]["precio"], 0); ?></span>
                            </div>
                            <h3><?php echo htmlspecialchars($discos[$i]["titulo"]); ?></h3>
                            <p class="artista"><?php echo htmlspecialchars($discos[$i]["artista"]); ?></p>
                            <p class="formato"><?php echo $discos[$i]["formatos"]; ?></p>
                            <a class="btn btn-tienda btn-sm" href="disco.php?id=<?php echo $discos[$i]["id"]; ?>">Ver disco</a>
                        </div>
                    </div>
<?php
}
?>
                </div>
            </div>
        </section>
<?php include "includes/pie.php"; ?>
