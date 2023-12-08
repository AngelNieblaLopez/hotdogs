
<?= $this->extend('layouts/base_layout');
$this->section('title'); ?> Listado de clientes <?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('clients/new') ?>" class="btn btn-primary">Nuevo cliente</a>
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
                <h5 class="card-title">Clientes</h5>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Apellido paterno</th>
                            <th>Apellido materno</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($clients) > 0) :
                            foreach ($clients as $client) : ?>
                                <tr>
                                    <td> <?= $client['id'] ?> </td>
                                    <td> <?= $client['name'] ?> </td>
                                    <td> <?= $client['last_name'] ?> </td>
                                    <td> <?= $client['second_last_name'] ?> </td>
                                    <td class="d-flex">
                                        <a href="<?= base_url("clients/" . $client["id"]) ?>" class="btn btn-sm btn-info mx-1" title="Mostrar"><i class="bi bi-info-square"></i></a>
                                        <a href="<?= base_url("clients/edit/" . $client["id"]) ?>" class="btn btn-sm btn-success mx-1" title="Editar"><i class="bi bi-pencil-square"></i></a>
                                        <form class="display-none" method="post" action="<?= base_url("api/web/clients/v1/" . $client["id"]) ?>" id="deleteClient<?= $client['id'] ?>">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <a href="javascript:void(0)" onclick="deleteClient('deleteClient<?= $client['id'] ?>')" class="btn btn-sm btn-danger" title="Eliminar"><i class="bi bi-trash"></i></a>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach;
                        else : ?>
                            <tr>
                                <td colspan="4">
                                    <h6 class="text-danger text-center">No se encontraron clientes</h6>
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
    function deleteClient(formId) {
        let confirm = window.confirm('¿Está seguro de eliminar este cliente?');
        if (confirm) {
            document.getElementById(formId).submit();
        }
    }
</script>

<?= $this->endSection(); ?>