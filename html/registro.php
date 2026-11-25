<?php
session_start();
include "includes/conexion.php";

$error = "";
$nombre = "";
$correo = "";
$direccion = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $direccion = trim($_POST["direccion"]);
    $contrasena = $_POST["contrasena"];
    $confirmar = $_POST["confirmar"];

    if ($nombre == "" || $correo == "" || $contrasena == "") {
        $error = "Llena tu nombre, correo y contraseña.";
    } else if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $error = "El correo no es válido.";
    } else if (strlen($contrasena) < 6) {
        $error = "La contraseña debe tener al menos 6 caracteres.";
    } else if ($contrasena != $confirmar) {
        $error = "Las contraseñas no coinciden.";
    } else {
        $correoBD = mysqli_real_escape_string($con, $correo);
        $resultado = mysqli_query($con, "SELECT id FROM usuarios WHERE correo='$correoBD';");

        if (mysqli_num_rows($resultado) > 0) {
            $error = "Ya existe una cuenta con ese correo.";
        } else {
            $nombreBD = mysqli_real_escape_string($con, $nombre);
            $direccionBD = mysqli_real_escape_string($con, $direccion);
            $contraCifrada = password_hash($contrasena, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (nombre, correo, contrasena, direccion)
                VALUES ('$nombreBD', '$correoBD', '$contraCifrada', '$direccionBD');";

            if (!mysqli_query($con, $sql)) {
                $error = "No se pudo crear la cuenta: " . mysqli_error($con);
            } else {
                $_SESSION["mensaje"] = "Tu cuenta se creó. Ya puedes iniciar sesión.";
                $_SESSION["correo_nuevo"] = $correo;
                mysqli_close($con);
                header("Location: cuenta.php");
                exit();
            }
        }
    }
}

mysqli_close($con);

$pagina = "cuenta";
$titulo = "Crear cuenta";
$subtitulo = "Regístrate para comprar discos";
include "includes/encabezado.php";
?>
        <section class="container px-4 px-lg-5">
            <div class="caja-form">
<?php
if ($error != "") {
    echo "<p class='aviso error'>" . $error . "</p>";
}
?>
                <form action="registro.php" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="nombre">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="correo">Correo</label>
                        <input class="form-control" type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($correo); ?>" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="contrasena">Contraseña</label>
                        <input class="form-control" type="password" id="contrasena" name="contrasena" minlength="6" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="confirmar">Confirmar contraseña</label>
                        <input class="form-control" type="password" id="confirmar" name="confirmar" minlength="6" required />
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="direccion">Dirección de envío (opcional)</label>
                        <input class="form-control" type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($direccion); ?>" />
                    </div>
                    <button class="btn btn-precio" type="submit">Crear cuenta</button>
                </form>
                <p class="mt-4 mb-0">¿Ya tienes cuenta? <a href="cuenta.php">Inicia sesión</a></p>
            </div>
        </section>
<?php include "includes/pie.php"; ?>
