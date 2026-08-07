<?php
require_once 'config/conexion.php';

$tituloPagina = 'Libros';
$pdo = obtenerConexion();

$categoriaSeleccionada = isset($_GET['categoria']) ? trim($_GET['categoria']) : '';

$categorias = $pdo->query('SELECT DISTINCT tipo FROM titulos ORDER BY tipo')->fetchAll();

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

<div class="page-heading">
    <h2><i class="bi bi-journal-bookmark"></i> Listado de libros</h2>
    <span class="count-pill"><?= $totalLibros ?> resultado(s)</span>
</div>

<div class="row g-4">
    <div class="col-lg-3">
        <div class="filter-panel">
            <form method="GET">
                <div class="mb-3">
                    <label for="categoria" class="form-label">Filtrar por categoria</label>
                    <select name="categoria" id="categoria" class="form-select" onchange="this.form.submit()">
                        <option value="">Todas las categorias</option>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?= htmlspecialchars($cat['tipo']) ?>" <?= $categoriaSeleccionada === $cat['tipo'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars(ucfirst($cat['tipo'])) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="buscador" class="form-label">Buscar en el catalogo</label>
                    <input type="text" id="buscador" class="form-control" placeholder="Escribe para filtrar...">
                </div>
                <?php if ($categoriaSeleccionada !== ''): ?>
                    <a href="libros.php" class="btn btn-outline-secondary w-100">Limpiar filtro</a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <div class="col-lg-9">
        <?php if ($totalLibros === 0): ?>
            <div class="panel text-center text-muted py-5">No se encontraron libros.</div>
        <?php else: ?>
            <div class="book-grid" id="listaLibros">
                <?php foreach ($libros as $libro): ?>
                    <div class="book-card item-buscable">
                        <div class="book-card__cover">
                            <i class="bi bi-book"></i>
                        </div>
                        <div class="book-card__body">
                            <p class="book-card__title"><?= htmlspecialchars($libro['titulo']) ?></p>
                            <div class="book-card__meta">
                                <span class="tag"><?= htmlspecialchars($libro['tipo']) ?></span>
                            </div>
                            <p class="book-card__publisher"><i class="bi bi-building"></i> <?= htmlspecialchars($libro['nombre_pub'] ?? 'N/D') ?></p>
                            <p class="book-card__date"><i class="bi bi-calendar3"></i> <?= date('d/m/Y', strtotime($libro['fecha_pub'])) ?></p>
                            <div class="book-card__footer">
                                <span class="book-card__price"><?= $libro['precio'] !== null ? '$' . number_format((float)$libro['precio'], 2) : 'N/D' ?></span>
                                <span class="book-card__sales"><i class="bi bi-graph-up"></i> <?= $libro['total_ventas'] !== null ? (int)$libro['total_ventas'] : 0 ?> ventas</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require 'includes/footer.php'; ?>
