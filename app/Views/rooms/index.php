
<?= $this->extend('layouts/base_layout');
$this->section('title'); ?> Listado de salas <?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('rooms/new') ?>" class="btn btn-primary">Nueva sala</a>
        </div>
    </div>
</div>

<div class="row py-2">
    <div class="col-xl-12">
        <?php
        if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php elseif (session()->getFlashdata('failed')) : ?>
            <div class="alert alert-danger alert-sismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <?= session()->getFlashdata('failed'); ?>
            </div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Salas</h5>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Disponible</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($rooms) > 0) :
                            foreach ($rooms as $room) : ?>
                                <tr>
                                    <td> <?= $room['id'] ?> </td>
                                    <td> <?= $room['name'] ?> </td>
                                    <td> <?= $room['type_room_name'] ?> </td>
                                    <td> <?= $room['available'] == "1"? "Sí" : "No"   ?> </td>
                                    <td class="d-flex">
                                        <a href="<?= base_url("rooms/" . $room["id"]) ?>" class="btn btn-sm btn-info mx-1" title="Mostrar"><i class="bi bi-info-square"></i></a>
                                        <a href="<?= base_url("rooms/edit/" . $room["id"]) ?>" class="btn btn-sm btn-success mx-1" title="Editar"><i class="bi bi-pencil-square"></i></a>
                                        <form class="display-none" method="post" action="<?= base_url("api/web/rooms/v1/" . $room["id"]) ?>" id="deleteRoom<?= $room['id'] ?>">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <a href="javascript:void(0)" onclick="deleteRoom('deleteRoom<?= $room['id'] ?>')" class="btn btn-sm btn-danger" title="Eliminar"><i class="bi bi-trash"></i></a>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach;
                        else : ?>
                            <tr>
                                <td colspan="4">
                                    <h6 class="text-danger text-center">No se encontraron salas</h6>
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