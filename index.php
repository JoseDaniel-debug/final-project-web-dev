<?php
require_once 'config/conexion.php';

$tituloPagina = 'Inicio';
$pdo = obtenerConexion();

// Totales usando PDO::query() + count()
$totalLibros  = count($pdo->query('SELECT id_titulo FROM titulos')->fetchAll());
$totalAutores = count($pdo->query('SELECT id_autor FROM autores')->fetchAll());
$totalEditoriales = count($pdo->query('SELECT id_pub FROM publicadores')->fetchAll());

// Últimos libros publicados (ejemplo de consulta con LIMIT)
$stmt = $pdo->query('SELECT titulo, tipo, precio, fecha_pub FROM titulos ORDER BY fecha_pub DESC LIMIT 5');
$ultimosLibros = $stmt->fetchAll();

require 'includes/header.php';
?>

<div class="hero text-center">
    <h1 class="display-5 fw-bold"><i class="bi bi-book"></i> Bienvenido a Librería Online</h1>
    <p class="lead mb-0">Consulta nuestro catálogo de libros, conoce a los autores y contáctanos.</p>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card card-resumen text-center p-4">
            <i class="bi bi-journal-bookmark display-4 text-primary mb-2"></i>
            <h3 class="fw-bold"><?= $totalLibros ?></h3>
            <p class="text-muted mb-0">Libros disponibles</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-resumen text-center p-4">
            <i class="bi bi-people display-4 text-primary mb-2"></i>
            <h3 class="fw-bold"><?= $totalAutores ?></h3>
            <p class="text-muted mb-0">Autores registrados</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-resumen text-center p-4">
            <i class="bi bi-building display-4 text-primary mb-2"></i>
            <h3 class="fw-bold"><?= $totalEditoriales ?></h3>
            <p class="text-muted mb-0">Editoriales</p>
        </div>
    </div>
</div>

<div class="card card-resumen p-4">
    <h4 class="mb-3"><i class="bi bi-clock-history"></i> Últimos libros publicados</h4>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Fecha de publicación</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ultimosLibros as $libro): ?>
                    <tr>
                        <td><?= htmlspecialchars($libro['titulo']) ?></td>
                        <td><span class="badge bg-secondary badge-tipo"><?= htmlspecialchars($libro['tipo']) ?></span></td>
                        <td><?= $libro['precio'] !== null ? '$' . number_format((float)$libro['precio'], 2) : 'N/D' ?></td>
                        <td><?= date('d/m/Y', strtotime($libro['fecha_pub'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a href="libros.php" class="btn btn-primary mt-2 align-self-start">
        Ver catálogo completo <i class="bi bi-arrow-right"></i>
    </a>
</div>

<?php require 'includes/footer.php'; ?>
