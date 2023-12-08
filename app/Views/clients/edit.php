<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Crear clientes
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('clients') ?>" class="btn btn-primary">Regresar a clientes</a>
        </div>

        <div class="row">
            <div class="col-xl-6 m-auto">
                <form action="<?= base_url('api/web/clients/v1/' . $client["id"]) ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Editar datos del cliente</h5>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="name" placeholder="Proporcione el nombre" value="<?php if ($client['name']) : echo $client['name'];
                                                                                                                                        else : set_value('name');
                                                                                                                                        endif ?>">
                                    </div>

                                    <div class=" form-group mb-3">
                                        <label clas="form-label">Apellido paterno</label>
                                        <input type="text" class="form-control" name="lastName" placeholder="Proporcione el apellido paterno" value="<?php if ($client['last_name']) : echo $client['last_name'];
                                                                                                                                                        else : set_value('last_name');
                                                                                                                                                        endif ?>">
                                    </div>
                                    <div class=" form-group mb-3">
                                        <label clas="form-label">Apellido materno</label>
                                        <input type="text" class="form-control" name="secondLastName" placeholder="Proporcione el apellido materno" value="<?php if ($client['second_last_name']) : echo $client['second_last_name'];
                                                                                                                                                            else : set_value('second_last_name');
                                                                                                                                                            endif ?>">
                                    </div>
                                    <div class=" form-group mb-3">
                                        <label clas="form-label">email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Proporcione el email" value="<?php if ($client['email']) : echo $client['email'];
                                                                                                                                        else : set_value('email');
                                                                                                                                        endif ?>">
                                    </div>
                                    <div class=" form-group mb-3">
                                        <label clas="form-label">Contraseña</label>
                                        <input type="password" class="form-control" name="password" placeholder="Proporcione la contraseña" value="<?php if ($client['password']) : echo $client['password'];
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

                                    <input id="roleId" hidden name="roleId">
                                    <button type="submit" class="btn btn-success">Guardar cliente</button>
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
        let client = <?= json_encode($client) ?>;

        if (roles.length !== 0) {
            $('#roleId').val(client.role_id);
            $("#role option").each((idx, option) => {
                option.selected = false;
                if (option.value == client.role_id) {
                    option.selected = true;
                }
            });
        }

        $('#role').change(function() {
            $('#roleId').val($(this).val());
        });
    });
</script>
<?= $this->endSection() ?>