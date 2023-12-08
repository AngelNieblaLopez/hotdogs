<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Login <?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container">
    <?php
    if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php elseif (session()->getFlashdata('failed')) : ?>
        <div class="alert alert-danger alert-sismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?= session()->getFlashdata('failed'); ?>
        </div>
    <?php endif; ?>
    <div class="row py-4">

        <div class="row">
            <div class="col-xl-6 m-auto">
                <form action="<?= base_url('api/web/workers/v1/login') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Iniciar sesión</h5>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Proporcione el email">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Contraseña</label>
                                        <input type="password" class="form-control" name="password" placeholder="Proporcione la contraseña">
                                    </div>


                                    <button type="submit" class="btn btn-success">Iniciar sesión</button>
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