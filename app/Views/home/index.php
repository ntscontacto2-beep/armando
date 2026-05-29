<div class="row">
  <div class="col-12">
    <h1 class="mb-3">Localiza tu puesto favorito</h1>
    <p class="text-muted">Explora los locales, consulta horarios y rutas para llegar rápido.</p>
  </div>

  <?php foreach (($destacados ?? []) as $l): ?>
    <div class="col-md-4 mb-3">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title"><?= e($l['nombre']) ?></h5>
          <p class="card-text">
            <strong>Categoría:</strong> <?= e($l['categoria']) ?><br>
            <strong>Ubicación:</strong> <?= e($l['ubicacion']) ?>
          </p>
          <a class="btn btn-primary" href="<?= base_url('locales/' . e($l['slug'])) ?>">Ver detalles</a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <?php if (empty($destacados)): ?>
    <div class="col-12">
      <div class="alert alert-info">Aún no hay locales destacados. Importa los datos de ejemplo en la base de datos.</div>
    </div>
  <?php endif; ?>
</div>
