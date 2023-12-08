<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Editar función <?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('functions') ?>" class="btn btn-primary">Regresar a funciones</a>
        </div>

        <div class="row">
            <div class="col-xl-6 m-auto">
                <form action="<?= base_url('api/web/functions/v1/' . $function["id"]) ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Editar datos de la función</h5>

                                    <div class="form-group mb-3">
                                        <label clas="form-label">Fecha de inicio</label>
                                        <input type="datetime-local" class="form-control" name="startDate" id="startDate"  value="<?= trim($function["start_date"]) ?>">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Película</label>
                                        <select class="form-control" id="movie">
                                            <option value="0">- Seleccione -</option>
                                            <?php foreach ($movies as $movie) : ?>
                                                <option value="<?= $movie['id'] ?>">
                                                    <?= $movie['name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Salas</label>
                                        <select class="form-control" id="room">
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
                                        <select class="form-control" id="functionStatus">
                                            <option disabled value="0">- Seleccione -</option>
                                            <?php foreach ($functionsStatus as $functionStatus) : ?>
                                                <option value="<?= $functionStatus['id'] ?>">
                                                    <?= $functionStatus['name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <input id="roomId" hidden name="roomId">
                                    <input id="movieId" hidden name="movieId">
                                    <input id="functionStatusId" hidden name="functionStatusId">
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

<script>
    $(document).ready(function() {

        let _function = <?= json_encode($function) ?>;
        let rooms = <?= json_encode($rooms) ?>;
        let movies = <?= json_encode($movies) ?>;
        let functionsStatus = <?= json_encode($functionsStatus) ?>;

        let minDate = new Date();
        minDate.setDate(minDate.getDate() - 1);
        $("#startDate").attr("min", minDate.toISOString().slice(0, 16));

        if (rooms.length !== 0) {
            $('#roomId').val(_function.room_id);
            $("#room option").each((_, option) => {
                if (option.value == _function.room_id) {
                    option.selected = true
                }
            });
        }

        if (movies.length !== 0) {
            $('#movieId').val(_function.movie_id);
            $("#movie option").each((_, option) => {
                if (option.value == _function.movie_id) {
                    option.selected = true
                }
            })
        }

        if (functionsStatus.length !== 0) {
            $('#functionStatusId').val(_function.function_status_id);
            $("#functionStatus option").each((_, option) => {
                if (option.value == _function.function_status_name) {
                    option.selected = true
                }
            })
        }

        $('#room').change(function() {
            $('#roomId').val($(this).val());
        });

        $('#movie').change(function() {
            $('#movieId').val($(this).val());
        });

        $('#functionStatus').change(function() {
            $('#functionStatusId').val($(this).val());
        });
    });
</script>
<?= $this->endSection() ?>