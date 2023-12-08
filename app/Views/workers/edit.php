<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Crear trabajador
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('workers') ?>" class="btn btn-primary">Regresar a trabajadores</a>
        </div>

        <div class="row">
            <div class="col-xl-6 m-auto">
                <form action="<?= base_url('api/web/workers/v1/' . $worker["id"]) ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Editar datos del trabajador</h5>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="name" placeholder="Proporcione el nombre" value="<?php if ($worker['name']) : echo $worker['name'];
                                                                                                                                            else : set_value('name');
                                                                                                                                            endif ?>">
                                    </div>

                                    <div class=" form-group mb-3">
                                        <label clas="form-label">Apellido paterno</label>
                                        <input type="text" class="form-control" name="lastName" placeholder="Proporcione el apellido paterno" value="<?php if ($worker['last_name']) : echo $worker['last_name'];
                                                                                                                                                        else : set_value('last_name');
                                                                                                                                                        endif ?>">
                                    </div>
                                    <div class=" form-group mb-3">
                                        <label clas="form-label">Apellido materno</label>
                                        <input type="text" class="form-control" name="secondLastName" placeholder="Proporcione el apellido materno" value="<?php if ($worker['second_last_name']) : echo $worker['second_last_name'];
                                                                                                                                                            else : set_value('second_last_name');
                                                                                                                                                            endif ?>">
                                    </div>
                                    <div class=" form-group mb-3">
                                        <label clas="form-label">email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Proporcione el email" value="<?php if ($worker['email']) : echo $worker['email'];
                                                                                                                                        else : set_value('email');
                                                                                                                                        endif ?>">
                                    </div>
                                    <div class=" form-group mb-3">
                                        <label clas="form-label">Contraseña</label>
                                        <input type="password" class="form-control" name="password" placeholder="Proporcione la contraseña" value="<?php if ($worker['password']) : echo $worker['password'];
                                                                                                                                                    else : set_value('password');
                                                                                                                                                    endif ?>">
                                    </div>
                                    <div class=" form-group mb-3">
                                        <label clas="form-label">Role</label>
                                        <select class="form-control" id="role">
                                            <option disabled value="0">- Seleccione -</option>
                                            <?php foreach ($roles as $rol) : ?>
                                                <option value="<?= $rol['id'] ?>">
                                                    <?= $rol['name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Tipo de trabajador</label>
                                        <select class="form-control" id="typeOfWorker">
                                            <option disabled value="0">- Seleccione -</option>
                                            <?php foreach ($typeOfWorkers as $typeOfWorker) : ?>
                                                <option value="<?= $typeOfWorker['id'] ?>">
                                                    <?= $typeOfWorker['name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <input id="roleId" hidden name="roleId">
                                    <input id="typeOfWorkerId" hidden name="typeOfWorkerId">

                                    <button type="submit" class="btn btn-success">Guardar trabajador</button>
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
<script>
    $(document).ready(function() {
        let roles = <?= json_encode($roles) ?>;
        let typeOfWorkers = <?= json_encode($typeOfWorkers) ?>;
        let worker = <?= json_encode($worker) ?>;

        if (roles.length !== 0) {
            $('#roleId').val(worker.role_id);
            $("#role option").each((idx, option) => {
                option.selected = false;
                if (option.value == worker.role_id) {
                    option.selected = true;
                }
            });
        }

        if (typeOfWorkers.length !== 0) {
            $('#typeOfWorkerId').val(worker.type_of_worker_id);
            $("#typeOfWorker option").each((idx, option) => {
                option.selected = false;
                if (option.value == worker.type_of_worker_id) {
                    option.selected = true;
                }
            })
        }

        $('#role').change(function() {
            $('#roleId').val($(this).val());
        });

        $('#typeOfWorker').change(function() {
            $('#typeOfWorkerId').val($(this).val());
        });
    });
</script>
<?= $this->endSection() ?>