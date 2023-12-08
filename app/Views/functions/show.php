<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Detalle función <?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('functions') ?>" class="btn btn-primary">Regresar a funciones</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Detalle función</h5>
                        <div class="form-group mb-3">
                            <label clas="form-label">Fecha de inicio</label>
                            <input type="datetime" class="form-control" name="startDate" disabled value="<?= trim($function["start_date"]) ?>">
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Película</label>
                            <select class="form-control" id="movie" disabled>
                                <option disabled value="0">- Seleccione -</option>
                                <?php foreach ($movies as $movie) : ?>
                                    <option value="<?= $movie['id'] ?>">
                                        <?= $movie['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Salas</label>
                            <select class="form-control" id="room" disabled>
                                <option disabled value="0">- Seleccione -</option>
                                <?php foreach ($rooms as $room) : ?>
                                    <option value="<?= $room['id'] ?>">
                                        <?= $room['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Estatus</label>
                            <select class="form-control" id="functionStatus" disabled>
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
<script>
    $(document).ready(function() {

        let _function = <?= json_encode($function) ?>;
        let rooms = <?= json_encode($rooms) ?>;
        let movies = <?= json_encode($movies) ?>;
        let functionsStatus = <?= json_encode($functionsStatus) ?>;


        if (rooms.length !== 0) {
            $('#roomId').val(rooms[0].id);
            $("#room option").each((_, option) => {
                if (option.value == _function.room_id) {
                    option.selected = true
                }
            });
        }

        if (movies.length !== 0) {
            $('#movieId').val(movies[0].id);
            $("#movie option").each((_, option) => {
                if (option.value == _function.movie_id) {
                    option.selected = true
                }
            })
        }

        if (functionsStatus.length !== 0) {
            $('#functionStatusId').val(functionsStatus[0].id);
            $("#functionStatus option").each((_, option) => {
                if (option.value == _function.function_status_id) {
                    option.selected = true
                }
            })
        }
    });
</script>
<?= $this->endSection() ?>