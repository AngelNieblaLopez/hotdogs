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
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title">Detalle de configuración</h5>
                                <div class="form-group mb-3">
                                    <label clas="form-label">Nombre</label>
                                    <input disabled type="text" class="form-control" name="name" placeholder="Proporcione el nombre" value="<?= trim($config["name"]) ?>">
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Entorno</label>
                                    <select disabled class="form-control" id="enviroment">
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
                                    <select disabled class="form-control" id="defaultCustomerRole">
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
                                    <select disabled class="form-control" id="workerApp">
                                        <option disabled value="0">- Seleccione -</option>
                                        <?php foreach ($workers as $worker) : ?>
                                            <option value="<?= $worker['id'] ?>">
                                                <?= $worker['user_name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">ID de función</label>
                                    <select disabled class="form-control" id="functionStatus">
                                        <option disabled value="0">- Seleccione -</option>
                                        <?php foreach ($functionsStatus as $functionStatus) : ?>
                                            <option value="<?= $functionStatus['id'] ?>">
                                                <?= $functionStatus['name'] ?>
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
    </div>
</div>
</div>

<script>
    $(document).ready(function () {
        let enviroments = <?= json_encode($enviroments) ?>;
        let roles = <?= json_encode($roles) ?>;
        let workers = <?= json_encode($workers) ?>;
        let config = <?= json_encode($config) ?>;
        let functionsStatus = <?= json_encode($functionsStatus) ?>;

        if (functionsStatus.length !== 0) {
            $("#functionStatus option").each((idx, option) => {
                option.selected = false;
                if (option.value == config.default_function_status_id) {
                    option.selected = true;
                }
            });
        }

        if (enviroments.length !== 0) {
            $("#enviroment option").each((idx, option) => {
                option.selected = false;
                if (option.value == config.enviroment_server_id) {
                    option.selected = true;
                }
            });
        }

        if (roles.length !== 0) {
            $("#defaultCustomerRole option").each((idx, option) => {
                option.selected = false;
                if (option.value == config.default_customer_role_id) {
                    option.selected = true;
                }
            })
        }

        if (workers.length !== 0) {
            $("#workerApp option").each((idx, option) => {
                option.selected = false;
                if (option.value == config.app_worker_id) {
                    option.selected = true;
                }
            })
        }
    });
</script>
<?= $this->endSection() ?>