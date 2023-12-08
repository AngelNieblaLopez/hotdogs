<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Editar sala
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('rooms') ?>" class="btn btn-primary">Regresar a salas</a>
        </div>

        <div class="row">
            <div class="col-xl-6 m-auto">
                <form action="<?= base_url('api/web/rooms/v1/' . $room["id"]) ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Editar datos de la sala</h5>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="name" placeholder="Proporcione el nombre" value="<?php if ($room['name']) : echo $room['name'];
                                                                                                                                            else : set_value('name');
                                                                                                                                            endif ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="checkbox" class="form-check-input" name="available" <?= $room["available"] == "1"? "checked" : "" ?>>
                                        <label class="form-check-label">Disponible</label>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Tipo de habitación</label>
                                        <select class="form-control" id="typeRoom">
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
                                        <select class="form-control" id="cinema">
                                            <option disabled value="0">- Seleccione -</option>
                                            <?php foreach ($cinemas as $cinema) : ?>
                                                <option value="<?= $cinema['id'] ?>">
                                                    <?= $cinema['name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>


                                    <input id="typeRoomId" hidden name="typeRoomId">
                                    <input id="cinemaId" hidden name="cinemaId">
                                    <button type="submit" class="btn btn-success">Guardar sala</button>
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
        let room = <?= json_encode($room) ?>;
        let typeRooms = <?= json_encode($typeRooms) ?>;
        let cinemas = <?= json_encode($cinemas) ?>;

        if (typeRooms.length !== 0) {
            $('#typeRoomId').val(room.type_room_id);
            $("#typeRoom option").each((_, option) => {
                if (option.value == room.type_room_id) {
                    option.selected = true
                }
            });
        }

        if (cinemas.length !== 0) {
            $('#cinemaId').val(room.cinema_id);
            $("#cinema option").each((_, option) => {
                if (option.value == room.cinema_id) {
                    option.selected = true
                }
            })
        }

        $('#typeRoom').change(function() {
            $('#typeRoomId').val($(this).val());
        });

        $('#cinema').change(function() {
            $('#cinemaId').val($(this).val());
        });
    });
</script>
<?= $this->endSection() ?>