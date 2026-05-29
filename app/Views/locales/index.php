<h1 class="mb-3">Locales</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Categoría</th>
      <th>Ubicación</th>
      <th>Vendedor</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($locales as $l): ?>
    <tr>
      <td><?= e($l['nombre']) ?></td>
      <td><?= e($l['categoria']) ?></td>
      <td><?= e($l['ubicacion']) ?></td>
      <td><?= e($l['vendedor']) ?></td>
      <td><a class="btn btn-sm btn-primary" href="<?= base_url('locales/' . e($l['slug'])) ?>">Abrir</a></td>
    </tr>
  <?php endforeach; ?>
  <?php if (empty($locales)): ?>
    <tr><td colspan="5" class="text-center text-muted">Sin resultados.</td></tr>
  <?php endif; ?>
  </tbody>
</table>
