<?php
$con = mysqli_connect("db", "usuario", "123456", "tienda_discos");

if (mysqli_connect_errno()) {
    echo "<p>Falló la conexión con MySQL: " . mysqli_connect_error() . "</p>";
}

mysqli_set_charset($con, "utf8mb4");
?>
