<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Crear nuevo trabajador
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('workers') ?>" class="btn btn-primary">Regresar a trabajadores</a>
        </div>

        <div class="row">
            <div class="col-xl-6 m-auto">
                <form action="<?= base_url('api/web/workers/v1') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Crear trabajador</h5>
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
                                    <div class="form-group mb-3">
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
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        let roles = <?= json_encode($roles) ?>;
        let typeOfWorkers = <?= json_encode($typeOfWorkers) ?>;


        if (roles.length !== 0) {
            $('#roleId').val(roles[0].id);
            $("#role option").each((_, option) => {
                if (option.value == roles[0].id) {
                    option.selected = true
                }
            });
        }

        if (typeOfWorkers.length !== 0) {
            $('#typeOfWorkerId').val(typeOfWorkers[0].id);
            $("#typeOfWorker option").each((_, option) => {
                if (option.value == typeOfWorkers[0].id) {
                    option.selected = true
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