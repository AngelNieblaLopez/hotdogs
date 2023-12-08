<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Crear nuevo tipo de sala <?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('typesRoom') ?>" class="btn btn-primary">Regresar a tipos de salas</a>
        </div>

        <div class="row">
            <div class="col-xl-6 m-auto">
                <form action="<?= base_url('api/web/typesRoom/v1/') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Crear tipo de sala</h5>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="name" placeholder="Proporcione el nombre">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Precio</label>
                                        <input type="number" class="form-control" name="price" placeholder="Proporcione el precio">
                                    </div>
                                    

                                    <button type="submit" class="btn btn-success">Guardar tipo de sala</button>
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