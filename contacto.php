<?php
require_once 'config/conexion.php';

$tituloPagina = 'Contacto';
$pdo = obtenerConexion();

$mensajeExito = '';
$mensajeError = '';

// Procesamiento del formulario enviado por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo     = trim($_POST['correo'] ?? '');
    $nombre     = trim($_POST['nombre'] ?? '');
    $asunto     = trim($_POST['asunto'] ?? '');
    $comentario = trim($_POST['comentario'] ?? '');

    // Validación básica en el servidor
    if ($nombre === '' || $correo === '' || $asunto === '' || $comentario === '') {
        $mensajeError = 'Por favor completa todos los campos.';
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensajeError = 'El correo electrónico no es válido.';
    } elseif (sizeof(explode(' ', $comentario)) < 1) {
        // Ejemplo de uso de sizeof() solicitado en el enunciado
        $mensajeError = 'El comentario no puede estar vacío.';
    } else {
        try {
            $sql = 'INSERT INTO contacto (fecha, correo, nombre, asunto, comentario)
                    VALUES (:fecha, :correo, :nombre, :asunto, :comentario)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':fecha'      => date('Y-m-d H:i:s'),
                ':correo'     => $correo,
                ':nombre'     => $nombre,
                ':asunto'     => $asunto,
                ':comentario' => $comentario,
            ]);

            $mensajeExito = '¡Gracias, ' . htmlspecialchars($nombre) . '! Tu mensaje fue enviado correctamente.';
            // Limpiamos los campos tras el envío exitoso
            $correo = $nombre = $asunto = $comentario = '';
        } catch (PDOException $e) {
            $mensajeError = 'Ocurrió un error al guardar tu mensaje. Intenta nuevamente.';
        }
    }
}

require 'includes/header.php';
?>

<h2 class="mb-4"><i class="bi bi-envelope"></i> Contáctanos</h2>

<div class="row">
    <div class="col-lg-7">
        <div class="card card-resumen p-4">

            <?php if ($mensajeExito !== ''): ?>
                <div class="alert alert-success" role="alert">
                    <i class="bi bi-check-circle"></i> <?= $mensajeExito ?>
                </div>
            <?php endif; ?>

            <?php if ($mensajeError !== ''): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-exclamation-triangle"></i> <?= htmlspecialchars($mensajeError) ?>
                </div>
            <?php endif; ?>

            <form id="formContacto" method="POST" action="contacto.php" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required
                           value="<?= htmlspecialchars($nombre ?? '') ?>">
                    <div class="invalid-feedback">Por favor ingresa tu nombre.</div>
                </div>

                <div class="mb-3">
                    <label for="correo" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="correo" name="correo" required
                           value="<?= htmlspecialchars($correo ?? '') ?>">
                    <div class="invalid-feedback">Ingresa un correo electrónico válido.</div>
                </div>

                <div class="mb-3">
                    <label for="asunto" class="form-label">Asunto</label>
                    <input type="text" class="form-control" id="asunto" name="asunto" required
                           value="<?= htmlspecialchars($asunto ?? '') ?>">
                    <div class="invalid-feedback">Por favor ingresa un asunto.</div>
                </div>

                <div class="mb-3">
                    <label for="comentario" class="form-label">Comentario</label>
                    <textarea class="form-control" id="comentario" name="comentario" rows="5" required><?= htmlspecialchars($comentario ?? '') ?></textarea>
                    <div class="invalid-feedback">Por favor escribe tu comentario.</div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send"></i> Enviar mensaje
                </button>
            </form>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card card-resumen p-4 h-100">
            <h5><i class="bi bi-info-circle"></i> Información</h5>
            <p class="text-muted">
                Utiliza este formulario para enviarnos tus comentarios, preguntas o
                sugerencias sobre nuestro catálogo de libros. Tu mensaje será
                almacenado en nuestra base de datos y te responderemos a la
                brevedad posible.
            </p>
        </div>
    </div>
</div>

<?php require 'includes/footer.php'; ?>
