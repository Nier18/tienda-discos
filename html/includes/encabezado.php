<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title><?php echo $titulo; ?> - Tienda de Discos</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php"><i class="bi-vinyl-fill me-1"></i>Tienda de Discos</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Menú"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link <?php if ($pagina == "inicio") echo "active"; ?>" href="index.php">Inicio</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php if ($pagina == "catalogo" || $pagina == "generos" || $pagina == "artistas") echo "active"; ?>" id="menuCatalogo" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Catálogo</a>
                            <ul class="dropdown-menu" aria-labelledby="menuCatalogo">
                                <li><a class="dropdown-item" href="catalogo.php">Todos los discos</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="generos.php">Géneros</a></li>
                                <li><a class="dropdown-item" href="artistas.php">Artistas</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link <?php if ($pagina == "acerca") echo "active"; ?>" href="acerca.php">Acerca de</a></li>
                    </ul>
                    <div class="d-flex">
                        <a class="btn btn-outline-dark me-2" href="cuenta.php">
                            <i class="bi-person-fill me-1"></i>
                            Iniciar sesión
                        </a>
                        <a class="btn btn-outline-dark" href="carrito.php">
                            <i class="bi-cart-fill me-1"></i>
                            Carrito
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder"><?php echo $titulo; ?></h1>
                    <p class="lead fw-normal text-white-50 mb-0"><?php echo $subtitulo; ?></p>
                </div>
            </div>
        </header>
