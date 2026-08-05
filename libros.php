<?php
require_once 'config/conexion.php';

$tituloPagina = 'Libros';
$pdo = obtenerConexion();

// Filtro opcional por categoría, recibido por GET
$categoriaSeleccionada = isset($_GET['categoria']) ? trim($_GET['categoria']) : '';

// Obtenemos las categorías disponibles para el filtro
$categorias = $pdo->query('SELECT DISTINCT tipo FROM titulos ORDER BY tipo')->fetchAll();

// Consulta principal: libros + nombre de la editorial, con PDO
if ($categoriaSeleccionada !== '') {
    $sql = 'SELECT t.id_titulo, t.titulo, t.tipo, t.precio, t.total_ventas, t.fecha_pub, p.nombre_pub
            FROM titulos t
            LEFT JOIN publicadores p ON t.id_pub = p.id_pub
            WHERE t.tipo = :tipo
            ORDER BY t.titulo ASC';
    $consulta = $pdo->prepare($sql);
    $consulta->execute([':tipo' => $categoriaSeleccionada]);
} else {
    $sql = 'SELECT t.id_titulo, t.titulo, t.tipo, t.precio, t.total_ventas, t.fecha_pub, p.nombre_pub
            FROM titulos t
            LEFT JOIN publicadores p ON t.id_pub = p.id_pub
            ORDER BY t.titulo ASC';
    $consulta = $pdo->query($sql);
}

$libros = $consulta->fetchAll();
$totalLibros = count($libros);

require 'includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
    <h2 class="mb-0"><i class="bi bi-journal-bookmark"></i> Listado de libros</h2>
    <span class="badge bg-primary fs-6"><?= $totalLibros ?> resultado(s)</span>
</div>

<div class="card card-resumen p-3 mb-4">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-sm-6 col-md-4">
            <label for="categoria" class="form-label">Filtrar por categoría</label>
            <select name="categoria" id="categoria" class="form-select" onchange="this.form.submit()">
                <option value="">Todas las categorías</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= htmlspecialchars($cat['tipo']) ?>" <?= $categoriaSeleccionada === $cat['tipo'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars(ucfirst($cat['tipo'])) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-sm-6 col-md-4">
            <label for="buscador" class="form-label">Buscar en la tabla</label>
            <input type="text" id="buscador" class="form-control" placeholder="Escribe para filtrar...">
        </div>
        <?php if ($categoriaSeleccionada !== ''): ?>
            <div class="col-auto">
                <a href="libros.php" class="btn btn-outline-secondary">Limpiar filtro</a>
            </div>
        <?php endif; ?>
    </form>
</div>

<div class="card card-resumen p-3">
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle" id="tablaDatos">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Título</th>
                    <th>Categoría</th>
                    <th>Editorial</th>
                    <th>Precio</th>
                    <th>Ventas totales</th>
                    <th>Fecha de publicación</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($totalLibros === 0): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">No se encontraron libros.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($libros as $libro): ?>
                        <tr>
                            <td><?= htmlspecialchars($libro['id_titulo']) ?></td>
                            <td><?= htmlspecialchars($libro['titulo']) ?></td>
                            <td><span class="badge bg-secondary badge-tipo"><?= htmlspecialchars($libro['tipo']) ?></span></td>
                            <td><?= htmlspecialchars($libro['nombre_pub'] ?? 'N/D') ?></td>
                            <td><?= $libro['precio'] !== null ? '$' . number_format((float)$libro['precio'], 2) : 'N/D' ?></td>
                            <td><?= $libro['total_ventas'] !== null ? (int)$libro['total_ventas'] : 0 ?></td>
                            <td><?= date('d/m/Y', strtotime($libro['fecha_pub'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require 'includes/footer.php'; ?>
