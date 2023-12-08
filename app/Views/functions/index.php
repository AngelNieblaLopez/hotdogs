<?= $this->extend('layouts/base_layout');
$this->section('title'); ?> Listado de funciones <?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('functions/new') ?>" class="btn btn-primary">Nueva función</a>
        </div>
    </div>
</div>


<div class="row py-2">
    <div class="col-xl-12">
        <?php
        if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert">&times;</button>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php elseif (session()->getFlashdata('failed')) : ?>
            <div class="alert alert-danger alert-sismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert">&times;</button>
                <?= session()->getFlashdata('failed'); ?>
            </div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Funciones</h5>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Sala</th>
                            <th>Fecha inicio</th>
                            <th>Estatus</th>
                            <th>Pelicula</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($functions) > 0) :
                            foreach ($functions as $function) : ?>
                                <tr>
                                    <td> <?= $function['id'] ?> </td>
                                    <td> <?= $function['room_name'] ?> </td>
                                    <td> <?= $function['start_date'] ?> </td>
                                    <td> <?= $function['function_status_name'] ?> </td>
                                    <td> <?= $function['movie_name'] ?> </td>
                                    <td class="d-flex">
                                        <a href="<?= base_url("functions/" . $function["id"]) ?>" class="btn btn-sm btn-info mx-1" title="Mostrar"><i class="bi bi-info-square"></i></a>
                                        <a href="<?= base_url("functions/edit/" . $function["id"]) ?>" class="btn btn-sm btn-success mx-1" title="Editar"><i class="bi bi-pencil-square"></i></a>
                                        <form class="display-none" method="post" action="<?= base_url("api/web/functions/v1/" . $function["id"]) ?>" id="deleteFunction<?= $function['id'] ?>">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <a href="javascript:void(0)" onclick="deleteFunction('deleteFunction<?= $function['id'] ?>')" class="btn btn-sm btn-danger" title="Eliminar"><i class="bi bi-trash"></i></a>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach;
                        else : ?>
                            <tr>
                                <td colspan="4">
                                    <h6 class="text-danger text-center">No se encontraron funciones</h6>
                                </td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function deleteFunction(formId) {
        let confirm = window.confirm('¿Está seguro de eliminar este rol?');
        if (confirm) {
            document.getElementById(formId).submit();
        }
    }
</script>

<?= $this->endSection(); ?>