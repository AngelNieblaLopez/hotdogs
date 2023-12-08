<?= $this->extend('layouts/base_layout');
$this->section('title'); ?> Listado de tipos de sala <?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('typesRoom/new') ?>" class="btn btn-primary">Nuevo tipo de sala</a>
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
                <h5 class="card-title">Tipos de salas</h5>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($typesRoom) > 0) :
                            foreach ($typesRoom as $typeRoom) : ?>
                                <tr>
                                    <td> <?= $typeRoom['id'] ?> </td>
                                    <td> <?= $typeRoom['name'] ?> </td>
                                    <td> $<?= $typeRoom['price'] ?> </td>
                                    <td class="d-flex">
                                        <a href="<?= base_url("typesRoom/" . $typeRoom["id"]) ?>" class="btn btn-sm btn-info mx-1" title="Mostrar"><i class="bi bi-info-square"></i></a>
                                        <a href="<?= base_url("typesRoom/edit/" . $typeRoom["id"]) ?>" class="btn btn-sm btn-success mx-1" title="Editar"><i class="bi bi-pencil-square"></i></a>
                                        <form class="display-none" method="post" action="<?= base_url("api/web/typesRoom/v1/" . $typeRoom["id"]) ?>" id="deleteRoom<?= $typeRoom['id'] ?>">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <a href="javascript:void(0)" onclick="deleteRoom('deleteRoom<?= $typeRoom['id'] ?>')" class="btn btn-sm btn-danger" title="Eliminar"><i class="bi bi-trash"></i></a>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach;
                        else : ?>
                            <tr>
                                <td colspan="4">
                                    <h6 class="text-danger text-center">No se encontraron tipos de salas</h6>
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
    function deleteRoom(formId) {
        let confirm = window.confirm('¿Está seguro de eliminar esta sala?');
        if (confirm) {
            document.getElementById(formId).submit();
        }
    }
</script>

<?= $this->endSection(); ?>