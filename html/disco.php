<?php
session_start();
include "includes/conexion.php";

$id = 0;
if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);
}

$sql = "SELECT a.*, ar.nombre AS artista, ar.pais, g.nombre AS genero
    FROM albumes a
    JOIN artistas ar ON ar.id = a.artista_id
    JOIN generos g ON g.id = a.genero_principal_id
    WHERE a.id = $id;";
$disco = mysqli_fetch_array(mysqli_query($con, $sql));

if (!$disco) {
    mysqli_close($con);
    header("Location: catalogo.php");
    exit();
}

$generos = array($disco["genero"]);
$resultado = mysqli_query($con, "SELECT g.nombre FROM generos_secundarios gs JOIN generos g ON g.id = gs.genero_id WHERE gs.album_id = $id;");
while ($row = mysqli_fetch_array($resultado)) {
    $generos[] = $row["nombre"];
}

$ediciones = mysqli_query($con, "SELECT * FROM ediciones WHERE album_id = $id ORDER BY formato;");
$canciones = mysqli_query($con, "SELECT * FROM canciones WHERE album_id = $id ORDER BY numero;");

$pagina = "catalogo";
$titulo = htmlspecialchars($disco["titulo"]);
$subtitulo = htmlspecialchars($disco["artista"]) . " · " . $disco["anio"];
include "includes/encabezado.php";
?>
        <section class="py-5">
            <div class="container px-4 px-lg-5">
                <div class="row gx-5">
                    <div class="col-md-5 mb-5">
                        <img class="portada-disco" src="img/discos/<?php echo $disco["portada"]; ?>" alt="Portada de <?php echo htmlspecialchars($disco["titulo"]); ?>" />
                        <p class="mt-4 mb-1"><strong>Artista:</strong> <?php echo htmlspecialchars($disco["artista"]); ?> (<?php echo $disco["pais"]; ?>)</p>
                        <p class="mb-1"><strong>Año:</strong> <?php echo $disco["anio"]; ?></p>
                        <p><strong>Género:</strong> <?php echo implode(", ", $generos); ?></p>
                    </div>
                    <div class="col-md-7">
                        <h2 class="titulo-seccion">Ediciones</h2>
                        <table class="table tabla-tienda mb-5">
                            <tr>
                                <th>Formato</th>
                                <th>Precio</th>
                                <th>Disponibles</th>
                            </tr>
<?php
while ($row = mysqli_fetch_array($ediciones)) {
    echo "<tr>";
    echo "<td>" . $row["formato"] . "</td>";
    echo "<td>$" . number_format($row["precio"], 2) . "</td>";
    if ($row["existencias"] == 0) {
        echo "<td>Agotado</td>";
    } else {
        echo "<td>" . $row["existencias"] . "</td>";
    }
    echo "</tr>";
}
?>
                        </table>
                        <h2 class="titulo-seccion">Canciones</h2>
                        <table class="table tabla-tienda">
<?php
while ($row = mysqli_fetch_array($canciones)) {
    $duracion = "";
    if ($row["duracion"] != "") {
        $partes = explode(":", $row["duracion"]);
        $duracion = intval($partes[0]) * 60 + intval($partes[1]) . ":" . $partes[2];
    }
    echo "<tr>";
    echo "<td class='numero'>" . $row["numero"] . "</td>";
    echo "<td>" . htmlspecialchars($row["titulo"]) . "</td>";
    echo "<td class='text-end'>" . $duracion . "</td>";
    echo "</tr>";
}
mysqli_close($con);
?>
                        </table>
                        <a class="btn btn-tienda mt-3" href="catalogo.php">Volver al catálogo</a>
                    </div>
                </div>
            </div>
        </section>
<?php include "includes/pie.php"; ?>
