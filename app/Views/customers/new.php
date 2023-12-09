<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Nuevo cliente
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('customers') ?>" class="btn btn-primary">Regresar</a>
        </div>

        <div class="row">
            <div class="col-xl-6 m-auto">
                <form action="<?= base_url('api/web/customers') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Nuevo cliente</h5>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="name" placeholder="Ingrese nombre">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Apellido paterno</label>
                                        <input type="text" class="form-control" name="lastName" placeholder="Ingrese apellido paterno ">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Apellido materno</label>
                                        <input type="text" class="form-control" name="secondLastName" placeholder="Ingrese apellido materno ">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Contraseña</label>
                                        <input type="password" class="form-control" name="password" placeholder="Ingrese contraseña ">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Ingrese email ">
                                    </div>

                                    <button type="submit" class="btn btn-success">Guardar</button>
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