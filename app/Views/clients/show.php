<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Crear nuevo cliente
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('clients') ?>" class="btn btn-primary">Regresar a clientes</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Detalle cliente</h5>
                        <div class="form-group mb-3">
                            <label clas="form-label">Name</label>
                            <input type="text" class="form-control" disabled name="name" placeholder="Proporcione el nombre " value="<?= trim($client["name"]) ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Apellido paterno</label>
                            <input type="text" class="form-control" disabled name="lastName" placeholder="Proporcione el apellido paterno " value="<?= trim($client["last_name"]) ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Apellido materno</label>
                            <input type="text" class="form-control" disabled name="secondLastName" placeholder="Proporcione el apellido materno " value="<?= trim($client["second_last_name"]) ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">email</label>
                            <input type="email" class="form-control" disabled name="email" placeholder="Proporcione el email " value="<?= trim($client["email"]) ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Contraseña</label>
                            <input type="password" class="form-control" disabled name="password" placeholder="Proporcione la contraseña" value="<?= trim($client["password"]) ?>">
                        </div>

                        <div class=" form-group mb-3">
                            <label clas="form-label">Role</label>
                            <select class="form-control" id="role" disabled>
                                <option disabled value="0">- Seleccione -</option>
                                <?php foreach ($roles as $rol) : ?>
                                    <option value="<?= $rol['id'] ?>">
                                        <?= $rol['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                </div>
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

    });
</script>
<?= $this->endSection() ?>