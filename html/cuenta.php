<?php
session_start();
include "includes/conexion.php";

$error = "";
$mensaje = "";
$correo = "";

if (isset($_SESSION["mensaje"])) {
    $mensaje = $_SESSION["mensaje"];
    unset($_SESSION["mensaje"]);
}

if (isset($_SESSION["correo_nuevo"])) {
    $correo = $_SESSION["correo_nuevo"];
    unset($_SESSION["correo_nuevo"]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST["correo"]);
    $contrasena = $_POST["contrasena"];

    $correoBD = mysqli_real_escape_string($con, $correo);
    $resultado = mysqli_query($con, "SELECT * FROM usuarios WHERE correo='$correoBD';");
    $row = mysqli_fetch_array($resultado);

    if ($row && password_verify($contrasena, $row["contrasena"])) {
        $_SESSION["usuario_id"] = $row["id"];
        $_SESSION["nombre"] = $row["nombre"];
        $_SESSION["correo"] = $row["correo"];
        mysqli_close($con);
        header("Location: index.php");
        exit();
    } else {
        $error = "Correo o contraseña incorrectos.";
    }
}

$usuario = null;
if (isset($_SESSION["usuario_id"])) {
    $id = $_SESSION["usuario_id"];
    $resultado = mysqli_query($con, "SELECT * FROM usuarios WHERE id=$id;");
    $usuario = mysqli_fetch_array($resultado);
}

mysqli_close($con);

$pagina = "cuenta";
if ($usuario) {
    $titulo = "Mi cuenta";
    $subtitulo = "Hola, " . htmlspecialchars($usuario["nombre"]);
} else {
    $titulo = "Iniciar sesión";
    $subtitulo = "Entra a tu cuenta o crea una";
}
include "includes/encabezado.php";
?>
        <section class="container px-4 px-lg-5">
            <div class="caja-form">
<?php
if ($usuario) {
?>
                <p><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario["nombre"]); ?></p>
                <p><strong>Correo:</strong> <?php echo htmlspecialchars($usuario["correo"]); ?></p>
                <p><strong>Dirección:</strong> <?php echo $usuario["direccion"] == "" ? "Sin dirección" : htmlspecialchars($usuario["direccion"]); ?></p>
                <p><strong>Cliente desde:</strong> <?php echo date("d/m/Y", strtotime($usuario["fecha_registro"])); ?></p>
                <a class="btn btn-tienda mt-2" href="salir.php">Cerrar sesión</a>
<?php
} else {
    if ($mensaje != "") {
        echo "<p class='aviso'>" . $mensaje . "</p>";
    }
    if ($error != "") {
        echo "<p class='aviso error'>" . $error . "</p>";
    }
?>
                <form action="cuenta.php" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="correo">Correo</label>
                        <input class="form-control" type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($correo); ?>" required />
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="contrasena">Contraseña</label>
                        <input class="form-control" type="password" id="contrasena" name="contrasena" required />
                    </div>
                    <button class="btn btn-precio" type="submit">Iniciar sesión</button>
                </form>
                <p class="mt-4 mb-0">¿No tienes cuenta? <a href="registro.php">Crea una</a></p>
<?php
}
?>
            </div>
        </section>
<?php include "includes/pie.php"; ?>
