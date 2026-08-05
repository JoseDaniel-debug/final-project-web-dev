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

<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
    <h2 class="mb-0"><i class="bi bi-people"></i> Listado de autores</h2>
    <span class="badge bg-primary fs-6"><?= $totalAutores ?> autor(es)</span>
</div>

<div class="card card-resumen p-3 mb-4">
    <label for="buscador" class="form-label">Buscar autor</label>
    <input type="text" id="buscador" class="form-control" placeholder="Busca por nombre, apellido, ciudad...">
</div>

<div class="card card-resumen p-3">
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle" id="tablaDatos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Ciudad</th>
                    <th>Estado</th>
                    <th>País</th>
                    <th>Código postal</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($totalAutores === 0): ?>
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">No hay autores registrados.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($autores as $autor): ?>
                        <tr>
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
