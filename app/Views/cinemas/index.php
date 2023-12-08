
<?= $this->extend('layouts/base_layout');
$this->section('title'); ?> Listado de cines <?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('cinemas/new') ?>" class="btn btn-primary">Nuevo cine</a>
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
                <h5 class="card-title">Cines</h5>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($cinemas) > 0) :
                            foreach ($cinemas as $cinema) : ?>
                                <tr>
                                    <td> <?= $cinema['id'] ?> </td>
                                    <td> <?= $cinema['name'] ?> </td>
                                    <td class="d-flex">
                                        <a href="<?= base_url("cinemas/" . $cinema["id"]) ?>" class="btn btn-sm btn-info mx-1" title="Mostrar"><i class="bi bi-info-square"></i></a>
                                        <a href="<?= base_url("cinemas/edit/" . $cinema["id"]) ?>" class="btn btn-sm btn-success mx-1" title="Editar"><i class="bi bi-pencil-square"></i></a>
                                        <form class="display-none" method="post" action="<?= base_url("api/web/cinemas/v1/" . $cinema["id"]) ?>" id="deleteCinema<?= $cinema['id'] ?>">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <a href="javascript:void(0)" onclick="deleteCinema('deleteCinema<?= $cinema['id'] ?>')" class="btn btn-sm btn-danger" title="Eliminar"><i class="bi bi-trash"></i></a>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach;
                        else : ?>
                            <tr>
                                <td colspan="4">
                                    <h6 class="text-danger text-center">No se encontraron cines</h6>
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
    function deleteCinema(formId) {
        let confirm = window.confirm('¿Está seguro de eliminar este cine?');
        if (confirm) {
            document.getElementById(formId).submit();
        }
    }
</script>

<?= $this->endSection(); ?>