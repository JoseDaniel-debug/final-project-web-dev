<?php
require_once 'config/conexion.php';

$tituloPagina = 'Autores';
$pdo = obtenerConexion();

$sql = 'SELECT id_autor, nombre, apellido, telefono, direccion, ciudad, estado, pais, cod_postal
        FROM autores
        ORDER BY apellido ASC, nombre ASC';
$autores = $pdo->query($sql)->fetchAll();

$totalAutores = count($autores);

require 'includes/header.php';
?>

<div class="page-heading">
    <h2><i class="bi bi-people"></i> Listado de autores</h2>
    <span class="count-pill"><?= $totalAutores ?> autor(es)</span>
</div>

<div class="panel mb-4">
    <label for="buscador" class="form-label">Buscar autor</label>
    <input type="text" id="buscador" class="form-control" placeholder="Busca por nombre, apellido, ciudad...">
</div>

<div class="panel table-panel p-0">
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Ciudad</th>
                    <th>Estado</th>
                    <th>Pais</th>
                    <th>Codigo postal</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($totalAutores === 0): ?>
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">No hay autores registrados.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($autores as $autor): ?>
                        <tr class="item-buscable">
                            <td><?= htmlspecialchars($autor['id_autor']) ?></td>
                            <td><?= htmlspecialchars(trim($autor['nombre'])) ?></td>
                            <td><?= htmlspecialchars(trim($autor['apellido'])) ?></td>
                            <td><?= htmlspecialchars($autor['telefono']) ?></td>
                            <td><?= htmlspecialchars($autor['direccion']) ?></td>
                            <td><?= htmlspecialchars($autor['ciudad']) ?></td>
                            <td><?= htmlspecialchars($autor['estado']) ?></td>
                            <td><?= htmlspecialchars($autor['pais']) ?></td>
                            <td><?= htmlspecialchars((string)$autor['cod_postal']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require 'includes/footer.php'; ?>
