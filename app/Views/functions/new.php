<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Crear nueva función <?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('functions') ?>" class="btn btn-primary">Regresar a funciones</a>
        </div>

        <div class="row">
            <div class="col-xl-6 m-auto">
                <form action="<?= base_url('api/web/functions/v1/') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Crear función</h5>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Fecha de inicio</label>
                                        <input type="datetime-local" class="form-control" name="startDate" id="startDate" min="2000-01-02T00:00:00">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Película</label>
                                        <select class="form-control" id="movie">
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
                                        <select class="form-control" id="room">
                                            <option disabled value="0">- Seleccione -</option>
                                            <?php foreach ($rooms as $room) : ?>
                                                <option value="<?= $room['id'] ?>">
                                                    <?= $room['name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                
                                    <input id="roomId" hidden name="roomId">
                                    <input id="movieId" hidden name="movieId">
                                    <button type="submit" class="btn btn-success">Guardar función</button>
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

        let rooms = <?= json_encode($rooms) ?>;
        let movies = <?= json_encode($movies) ?>;

        let minDate = new Date();
        minDate.setDate(minDate.getDate() - 1);
        $("#startDate").attr("min", minDate.toISOString().slice(0, 16));

        if (rooms.length !== 0) {
            $('#roomId').val(rooms[0].id);
            $("#room option").each((_, option) => {
                if (option.value == rooms[0].id) {
                    option.selected = true
                }
            });
        }

        if (movies.length !== 0) {
            $('#movieId').val(movies[0].id);
            $("#movie option").each((_, option) => {
                if (option.value == movies[0].id) {
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
    });
</script>
<?= $this->endSection() ?>