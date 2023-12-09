<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Nuevo trabajador
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('sellers') ?>" class="btn btn-primary">Regresar</a>
        </div>

        <div class="row">
            <div class="col-xl-6 m-auto">
                <form action="<?= base_url('api/web/sellers/' . $seller["id"]) ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Editar trabajador</h5>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="name" placeholder="Ingrese nombre" value="<?php if ($seller['name']) : echo $seller['name'];
                                                                                                                                else : set_value('name');
                                                                                                                                endif ?>">
                                    </div>

                                    <div class=" form-group mb-3">
                                        <label clas="form-label">Apellido paterno</label>
                                        <input type="text" class="form-control" name="lastName" placeholder="Ingrese apellido paterno" value="<?php if ($seller['last_name']) : echo $seller['last_name'];
                                                                                                                                                else : set_value('last_name');
                                                                                                                                                endif ?>">
                                    </div>
                                    <div class=" form-group mb-3">
                                        <label clas="form-label">Apellido materno</label>
                                        <input type="text" class="form-control" name="secondLastName" placeholder="Ingrese apellido materno" value="<?php if ($seller['second_last_name']) : echo $seller['second_last_name'];
                                                                                                                                                    else : set_value('second_last_name');
                                                                                                                                                    endif ?>">
                                    </div>
                                <div class=" form-group mb-3">
                                    <label clas="form-label">Contraseña</label>
                                    <input type="password" class="form-control" name="password" placeholder="Ingrese contraseña" value="<?php if ($seller['password']) : echo $seller['password'];
                                                                                                                                        else : set_value('password');
                                                                                                                                        endif ?>">
                                </div>
                                <div class=" form-group mb-3">
                                    <label clas="form-label">email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Ingrese email" value="<?php if ($seller['email']) : echo $seller['email'];
                                                                                                                                else : set_value('email');
                                                                                                                                endif ?>">

                                </div>
                                <button type="submit" class="btn btn-success">Guardar</button>
                                </div>

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