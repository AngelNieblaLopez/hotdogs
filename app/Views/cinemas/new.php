<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Crear nuevo cine
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('cinemas') ?>" class="btn btn-primary">Regresar a cines</a>
        </div>

        <div class="row">
            <div class="col-xl-6 m-auto">
                <form action="<?= base_url('api/web/cinemas/v1') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Crear cine</h5>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="name" placeholder="Proporcione el nombre ">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Descripción ubicación</label>
                                        <input type="text" class="form-control" name="locationDescription" placeholder="Proporcione descripción de locación ">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Lat</label>
                                        <input type="text" class="form-control" name="locationLat" placeholder="Proporcione la latitud de cine ">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">long</label>
                                        <input type="text" class="form-control" name="locationLongi" placeholder="Proporcione la longitud del cine">
                                    </div>

                                    <button type="submit" class="btn btn-success">Guardar cine</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>