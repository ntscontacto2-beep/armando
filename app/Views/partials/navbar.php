<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?= base_url() ?>">Tianguis SMT</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="nav" class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('locales') ?>">Locales</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('rutas') ?>">Rutas</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= base_url('historia') ?>">Historia</a></li>
      </ul>
      <form class="d-flex" method="get" action="<?= base_url('locales') ?>">
        <input class="form-control me-2" name="q" value="<?= e($q ?? '') ?>" placeholder="Buscar local...">
        <button class="btn btn-outline-light">Buscar</button>
      </form>
    </div>
  </div>
</nav>
