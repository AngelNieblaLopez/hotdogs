<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Detalle tipo de sala <?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('typesRoom') ?>" class="btn btn-primary">Regresar a tipos de salas</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Detalle de sala</h5>
                        <div class="form-group mb-3">
                            <label clas="form-label">Nombre</label>
                            <input type="text" class="form-control" disabled value="<?= trim($typeRoom["name"]) ?>">
                        </div>

                        <div class="form-group mb-3">
                            <label clas="form-label">Precio</label>
                            <input type="number" class="form-control" disabled value="<?= trim($typeRoom["price"]) ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>