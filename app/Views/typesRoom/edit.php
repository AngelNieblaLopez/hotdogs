<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Editar tipo de sala <?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('typesRoom') ?>" class="btn btn-primary">Regresar a tipos de salas</a>
        </div>

        <div class="row">
            <div class="col-xl-6 m-auto">
                <form action="<?= base_url('api/web/typesRoom/v1/'.$typeRoom["id"]) ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Editar datos del rol</h5>
                                 
                                    <div class="form-group mb-3">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="name" placeholder="Proporcione el nombre" value="<?php if ($typeRoom['name']) : echo $typeRoom['name'];
                                                                                                                                                        else : set_value('name');
                                                                                                                                                        endif ?>">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Pricio</label>
                                        <input type="text" class="form-control" name="price" placeholder="Proporcione el precio" value="<?php if ($typeRoom['price']) : echo $typeRoom['price'];
                                                                                                                                                        else : set_value('price');
                                                                                                                                                        endif ?>">
                                    </div>
                                    
                                    <button type="submit" class="btn btn-success">Modificar</button>
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