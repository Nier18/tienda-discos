<?php
session_start();
include "includes/conexion.php";

$sql = "SELECT a.id, a.titulo, a.anio, a.portada, ar.nombre AS artista,
        MIN(e.precio) AS precio,
        GROUP_CONCAT(e.formato ORDER BY e.formato SEPARATOR ' · ') AS formatos
    FROM albumes a
    JOIN artistas ar ON ar.id = a.artista_id
    JOIN ediciones e ON e.album_id = a.id
    GROUP BY a.id
    ORDER BY ar.nombre, a.anio;";
$resultado = mysqli_query($con, $sql);

$pagina = "catalogo";
$titulo = "Catálogo";
$subtitulo = mysqli_num_rows($resultado) . " discos en vinilo, CD y casete";
include "includes/encabezado.php";
?>
        <section class="py-5">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">
<?php
while ($row = mysqli_fetch_array($resultado)) {
?>
                    <div class="col">
                        <div class="disco">
                            <a class="funda d-block" href="disco.php?id=<?php echo $row["id"]; ?>">
                                <img class="vinilo" src="img/vinilo.png" alt="" />
                                <img class="portada" src="img/discos/<?php echo $row["portada"]; ?>" alt="Portada de <?php echo htmlspecialchars($row["titulo"]); ?>" />
                                <span class="precio">$<?php echo number_format($row["precio"], 0); ?></span>
                            </a>
                            <h3><?php echo htmlspecialchars($row["titulo"]); ?></h3>
                            <p class="artista"><?php echo htmlspecialchars($row["artista"]); ?> · <?php echo $row["anio"]; ?></p>
                            <p class="formato"><?php echo $row["formatos"]; ?></p>
                            <a class="btn btn-tienda btn-sm" href="disco.php?id=<?php echo $row["id"]; ?>">Ver disco</a>
                        </div>
                    </div>
<?php
}
mysqli_close($con);
?>
                </div>
            </div>
        </section>
<?php include "includes/pie.php"; ?>
