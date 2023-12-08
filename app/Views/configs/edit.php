<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Editar configuración
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('configs') ?>" class="btn btn-primary">Regresar a configuraciones</a>
        </div>

        <div class="row">
            <div class="col-xl-6 m-auto">
                <form action="<?= base_url('api/web/configs/v1/' . $config["id"]) ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Editar datos de la configuración</h5>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="name" placeholder="Proporcione el nombre" value="<?php if ($config['name']) : echo $config['name'];
                                                                                                                                        else : set_value('name');
                                                                                                                                        endif ?>">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Entorno</label>
                                        <select class="form-control" id="enviromentServer">
                                            <option disabled value="0">- Seleccione -</option>
                                            <?php foreach ($enviroments as $enviroment) : ?>
                                                <option value="<?= $enviroment['id'] ?>">
                                                    <?= $enviroment['name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Rol por defecto de cliente</label>
                                        <select class="form-control" id="defaultCustomerRole">
                                            <option disabled value="0">- Seleccione -</option>
                                            <?php foreach ($roles as $role) : ?>
                                                <option value="<?= $role['id'] ?>">
                                                    <?= $role['name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Id de trabajador de app</label>
                                        <select class="form-control" id="workerApp">
                                            <option disabled value="0">- Seleccione -</option>
                                            <?php foreach ($workers as $worker) : ?>
                                                <option value="<?= $worker['id'] ?>">
                                                    <?= $worker['user_name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Id de función</label>
                                        <select class="form-control" id="functionStatus">
                                            <option disabled value="0">- Seleccione -</option>
                                            <?php foreach ($functionsStatus as $functionStatus) : ?>
                                                <option value="<?= $functionStatus['id'] ?>">
                                                    <?= $functionStatus['name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <input id="enviromentServerId" hidden name="enviromentServerId">
                                    <input id="defaultCustomerRoleId" hidden name="defaultCustomerRoleId">
                                    <input id="workerAppId" hidden name="workerAppId">
                                    <input id="functionStatusId" hidden name="functionStatusId">

                                    <button type="submit" class="btn btn-success">Guardar configuración</button>
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
        let enviroments = <?= json_encode($enviroments) ?>;
        let roles = <?= json_encode($roles) ?>;
        let workers = <?= json_encode($workers) ?>;
        let config = <?= json_encode($config) ?>;
        let functionsStatus = <?= json_encode($functionsStatus) ?>;

        if (functionsStatus.length !== 0) {
            $('#functionStatusId').val(config.default_function_status_id);
            $("#functionStatus option").each((idx, option) => {
                option.selected = false;
                if (option.value == config.default_function_status_id) {
                    option.selected = true;
                }
            });
        }

        if (enviroments.length !== 0) {
            $('#enviromentServerId').val(config.enviroment_server_id);
            $("#enviromentServer option").each((idx, option) => {
                option.selected = false;
                if (option.value == config.enviroment_server_id) {
                    option.selected = true;
                }
            });
        }

        if (roles.length !== 0) {
            $('#defaultCustomerRoleId').val(config.default_customer_role_id);
            $("#defaultCustomerRole option").each((idx, option) => {
                option.selected = false;
                if (option.value == config.default_customer_role_id) {
                    option.selected = true;
                }
            })
        }

        if (workers.length !== 0) {
            $('#workerAppId').val(config.app_worker_id);
            $("#workerApp option").each((idx, option) => {
                option.selected = false;
                if (option.value == config.app_worker_id) {
                    option.selected = true;
                }
            })
        }

        $('#enviromentServer').change(function() {
            $('#enviromentServerId').val($(this).val());
        });

        $('#defaultCustomerRole').change(function() {
            $('#defaultCustomerRoleId').val($(this).val());
        });

        $('#workerApp').change(function() {
            $('#workerAppId').val($(this).val());
        });

        $('#functionStatus').change(function() {
            $('#functionStatusId').val($(this).val());
        });
    });
</script>
<?= $this->endSection() ?>