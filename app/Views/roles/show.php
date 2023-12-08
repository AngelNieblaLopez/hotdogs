<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Crear nuevo rol <?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('roles') ?>" class="btn btn-primary">Regresar a roles</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Mostrar role</h5>
                        <div class="form-group mb-3">
                            <label clas="form-label">Nombre</label>
                            <input type="text" class="form-control" disabled value="<?= trim($role["name"]) ?>">
                        </div>

                        <div class="form-group mb-3">
                            <input type="checkbox" class="form-check-input" disabled  <?= $role["is_worker"] == "1"? "checked" : "" ?>>
                            <label class="form-check-label">Es trabajador</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>