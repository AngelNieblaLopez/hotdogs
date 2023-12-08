<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Editar role <?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('roles') ?>" class="btn btn-primary">Regresar a roles</a>
        </div>

        <div class="row">
            <div class="col-xl-6 m-auto">
                <form action="<?= base_url('api/web/roles/v1/'.$role["id"]) ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Editar datos del rol</h5>
                                 
                                    <div class="form-group mb-3">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="name" placeholder="Proporcione el nombre del role" value="<?php if ($role['name']) : echo $role['name'];
                                                                                                                                                        else : set_value('');
                                                                                                                                                        endif ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="checkbox" class="form-check-input" name="is_worker"  <?= $role["is_worker"] == "1"? "checked" : "" ?>>
                                            
                                        <label class="form-check-label">Es trabajador</label>
                                    </div>
                                    <button type="submit" class="btn btn-success">Modificar datos</button>
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