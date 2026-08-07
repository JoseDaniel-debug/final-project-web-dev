<?php
require_once 'config/conexion.php';

$tituloPagina = 'Inicio';
$pdo = obtenerConexion();

$totalLibros  = count($pdo->query('SELECT id_titulo FROM titulos')->fetchAll());
$totalAutores = count($pdo->query('SELECT id_autor FROM autores')->fetchAll());
$totalEditoriales = count($pdo->query('SELECT id_pub FROM publicadores')->fetchAll());

$stmt = $pdo->query('SELECT titulo, tipo, precio, fecha_pub FROM titulos ORDER BY fecha_pub DESC LIMIT 6');
$ultimosLibros = $stmt->fetchAll();

require 'includes/header.php';
?>

<div class="hero">
    <div class="hero__content">
        <span class="hero__eyebrow">Catalogo digital</span>
        <h1 class="fw-bold mt-2">Bienvenido a Libreria Jose Daniel</h1>
        <p class="lead mb-0">Consulta nuestro catalogo de libros y dejame tu comentario para que el profe me ponga nota.</p>
    </div>
    <i class="bi bi-book hero__icon"></i>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <span class="stat-card__icon stat-card__icon--primary"><i class="bi bi-journal-bookmark"></i></span>
            <div>
                <p class="stat-card__value"><?= $totalLibros ?></p>
                <p class="stat-card__label">Libros disponibles</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <span class="stat-card__icon stat-card__icon--accent"><i class="bi bi-people"></i></span>
            <div>
                <p class="stat-card__value"><?= $totalAutores ?></p>
                <p class="stat-card__label">Autores registrados</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <span class="stat-card__icon stat-card__icon--dark"><i class="bi bi-building"></i></span>
            <div>
                <p class="stat-card__value"><?= $totalEditoriales ?></p>
                <p class="stat-card__label">Editoriales</p>
            </div>
        </div>
    </div>
</div>

<div class="panel">
    <h4 class="panel__title"><i class="bi bi-clock-history"></i> Ultimos libros publicados</h4>
    <div class="row g-3">
        <?php foreach ($ultimosLibros as $libro): ?>
            <div class="col-sm-6 col-lg-4">
                <div class="mini-book">
                    <span class="mini-book__icon"><i class="bi bi-book"></i></span>
                    <div>
                        <p class="mini-book__title"><?= htmlspecialchars($libro['titulo']) ?></p>
                        <p class="mini-book__sub">
                            <?= htmlspecialchars(ucfirst($libro['tipo'])) ?> &middot;
                            <?= $libro['precio'] !== null ? '$' . number_format((float)$libro['precio'], 2) : 'N/D' ?> &middot;
                            <?= date('d/m/Y', strtotime($libro['fecha_pub'])) ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="libros.php" class="btn btn-primary mt-4 align-self-start">
        Ver catalogo completo <i class="bi bi-arrow-right"></i>
    </a>
</div>

<?php require 'includes/footer.php'; ?>
