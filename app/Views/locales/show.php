<?php if (!$local): ?>
  <div class="alert alert-danger">El local no existe.</div>
  <a class="btn btn-secondary" href="<?= base_url('locales') ?>">Volver</a>
<?php else: ?>
  <h1 class="mb-3"><?= e($local['nombre']) ?></h1>
  <p><strong>Categoría:</strong> <?= e($local['categoria']) ?></p>
  <p><strong>Ubicación:</strong> <?= e($local['ubicacion']) ?></p>
  <p><strong>Vendedor:</strong> <?= e($local['vendedor']) ?><?php if (!empty($local['telefono'])): ?> | <strong>Tel:</strong> <?= e($local['telefono']) ?><?php endif; ?></p>
  <?php if (!empty($local['descripcion'])): ?>
    <div class="mb-3"><?= nl2br(e($local['descripcion'])) ?></div>
  <?php endif; ?>

  <a class="btn btn-secondary" href="<?= base_url('locales') ?>">Volver</a>
<?php endif; ?>
