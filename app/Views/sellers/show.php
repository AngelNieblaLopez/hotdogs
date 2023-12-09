<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Datos trabajador
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('sellers') ?>" class="btn btn-primary">Regresar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Datos trabajador</h5>
                        <div class="form-group mb-3">
                            <label clas="form-label">Name</label>
                            <input type="text" class="form-control" disabled name="name" placeholder="Ingrese nombre " value="<?= trim($seller["name"]) ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Apellido paterno</label>
                            <input type="text" class="form-control" disabled name="lastName" placeholder="Ingrese apellido paterno " value="<?= trim($seller["last_name"]) ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Apellido materno</label>
                            <input type="text" class="form-control" disabled name="secondLastName" placeholder="Ingrese apellido materno " value="<?= trim($seller["second_last_name"]) ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Contraseña</label>
                            <input type="password" class="form-control" disabled name="password" placeholder="Ingrese contraseña" value="<?= trim($seller["password"]) ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">email</label>
                            <input type="email" class="form-control" disabled name="email" placeholder="Ingrese email " value="<?= trim($seller["email"]) ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>