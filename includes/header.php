<?php if (!isset($tituloPagina)) { $tituloPagina = 'Libreria Online'; } ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($tituloPagina) ?> - Libreria Online</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,700;9..144,800&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="site-topbar">
    <div class="container site-topbar__inner">
        <a class="brand" href="index.php">
            <span class="brand__mark"><i class="bi bi-bookshelf"></i></span>
            <span class="brand__text">Libreria Jose Daniel</span>
        </a>
        <button class="nav-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-label="Abrir menu">
            <i class="bi bi-list"></i>
        </button>
        <nav class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="nav-links">
                <li><a class="nav-links__item <?= basename($_SERVER['PHP_SELF']) === 'index.php' ? 'is-active' : '' ?>" href="index.php">Inicio</a></li>
                <li><a class="nav-links__item <?= basename($_SERVER['PHP_SELF']) === 'libros.php' ? 'is-active' : '' ?>" href="libros.php">Libros</a></li>
                <li><a class="nav-links__item <?= basename($_SERVER['PHP_SELF']) === 'autores.php' ? 'is-active' : '' ?>" href="autores.php">Autores</a></li>
                <li><a class="nav-links__item <?= basename($_SERVER['PHP_SELF']) === 'contacto.php' ? 'is-active' : '' ?>" href="contacto.php">Contacto</a></li>
            </ul>
        </nav>
    </div>
</header>

<main class="container site-main">
