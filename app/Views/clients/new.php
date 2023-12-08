<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Crear nuevo cliente
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('clients') ?>" class="btn btn-primary">Regresar a clientes</a>
        </div>

        <div class="row">
            <div class="col-xl-6 m-auto">
                <form action="<?= base_url('api/web/clients/v1') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Crear cliente</h5>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="name" placeholder="Proporcione el nombre ">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Apellido paterno</label>
                                        <input type="text" class="form-control" name="lastName" placeholder="Proporcione el apellido paterno ">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Apellido materno</label>
                                        <input type="text" class="form-control" name="secondLastName" placeholder="Proporcione el apellido materno ">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Proporcione el email ">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Contraseña</label>
                                        <input type="password" class="form-control" name="password" placeholder="Proporcione la contraseña ">
                                    </div>

                                    <button type="submit" class="btn btn-success">Guardar cliente</button>
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