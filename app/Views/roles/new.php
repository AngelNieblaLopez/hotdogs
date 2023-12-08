<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Crear nuevo role <?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('roles') ?>" class="btn btn-primary">Regresar a roles</a>
        </div>

        <div class="row">
            <div class="col-xl-6 m-auto">
                <form action="<?= base_url('api/web/roles/v1/') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Crear role</h5>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Role</label>
                                        <input type="text" class="form-control" name="name" placeholder="Proporcione el nombre del role">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="checkbox" class="form-check-input" name="is_worker" 
                                        >
                                        <label class="form-check-label">Es trabajador</label>
                                    </div>

                                    <button type="submit" class="btn btn-success">Guardar rol</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>