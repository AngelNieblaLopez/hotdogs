<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Detalle sala
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('clients') ?>" class="btn btn-primary">Regresar a salas</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Detalle sala</h5>
                        <div class="form-group mb-3">
                            <label clas="form-label">Name</label>
                            <input type="text" class="form-control" disabled name="name" placeholder="Proporcione el nombre " value="<?= trim($room["name"]) ?>">
                        </div>

                        <div class="form-group mb-3">
                            <input type="checkbox" class="form-check-input" name="available" <?= $room["available"] == "1"? "checked" : "" ?>>
                            <label class="form-check-label">Disponible</label>
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Tipo de habitación</label>
                            <select class="form-control" id="typeRoom" disabled>
                                <option disabled value="0">- Seleccione -</option>
                                <?php foreach ($typeRooms as $typeRoom) : ?>
                                    <option value="<?= $typeRoom['id'] ?>">
                                        <?= $typeRoom['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Cine</label>
                            <select class="form-control" id="cinema" disabled>
                                <option disabled value="0">- Seleccione -</option>
                                <?php foreach ($cinemas as $cinema) : ?>
                                    <option value="<?= $cinema['id'] ?>">
                                        <?= $cinema['name'] ?>
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
        let room = <?= json_encode($room) ?>;
        let typeRooms = <?= json_encode($typeRooms) ?>;
        let cinemas = <?= json_encode($cinemas) ?>;


        if (typeRooms.length !== 0) {
            $("#typeRoom option").each((_, option) => {
                if (option.value == room.type_room_id) {
                    option.selected = true
                }
            });
        }

        if (cinemas.length !== 0) {
            $("#cinema option").each((_, option) => {
                if (option.value == room.cinema_id) {
                    option.selected = true
                }
            })
        }
    });
</script>
<?= $this->endSection() ?>