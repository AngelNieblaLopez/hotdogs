<?= $this->extend('layouts/base_layout');
$this->section('title'); ?> Listado de roles <?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('roles/new') ?>" class="btn btn-primary">Nuevo rol</a>
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
                <h5 class="card-title">Roles</h5>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Es trabajador</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($roles) > 0) :
                            foreach ($roles as $role) : ?>
                                <tr>
                                    <td> <?= $role['id'] ?> </td>
                                    <td> <?= $role['name'] ?> </td>
                                    <td> <?= $role['is_worker'] == "1"? "Sí" : "No"   ?> </td>
                                    <td class="d-flex">
                                        <a href="<?= base_url("roles/" . $role["id"]) ?>" class="btn btn-sm btn-info mx-1" title="Mostrar"><i class="bi bi-info-square"></i></a>
                                        <a href="<?= base_url("roles/edit/" . $role["id"]) ?>" class="btn btn-sm btn-success mx-1" title="Editar"><i class="bi bi-pencil-square"></i></a>
                                        <form class="display-none" method="post" action="<?= base_url("api/web/roles/v1/" . $role["id"]) ?>" id="deleteRole<?= $role['id'] ?>">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <a href="javascript:void(0)" onclick="deleteRole('deleteRole<?= $role['id'] ?>')" class="btn btn-sm btn-danger" title="Eliminar"><i class="bi bi-trash"></i></a>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach;
                        else : ?>
                            <tr>
                                <td colspan="4">
                                    <h6 class="text-danger text-center">No se encontraron roles</h6>
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
    function deleteRole(formId) {
        let confirm = window.confirm('¿Está seguro de eliminar este rol?');
        if (confirm) {
            document.getElementById(formId).submit();
        }
    }
</script>

<?= $this->endSection(); ?>