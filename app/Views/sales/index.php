
<?= $this->extend('layouts/base_layout');
$this->section('title'); ?> Listado de ventas <?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="row py-2">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Ventas</h5>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Cliente</th>
                            <th>Vendedor</th>
                            <th>Total</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($sales) > 0) :
                            foreach ($sales as $sale) : ?>
                                <tr>
                                    <td> <?= $sale['id'] ?> </td>
                                    <td> <?= $sale['client_user_name'] ?> </td>
                                    <td> <?= $sale['worker_user_name'] ?> </td>
                                    <td> <?= $sale['payment_info_total'] ?> </td>
                                    <td class="d-flex">
                                        <a href="<?= base_url("sales/" . $sale["id"]) ?>" class="btn btn-sm btn-info mx-1" title="Mostrar"><i class="bi bi-info-square"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach;
                        else : ?>
                            <tr>
                                <td colspan="4">
                                    <h6 class="text-danger text-center">No se encontraron ventas</h6>
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
    function deleteUser(formId) {
        let confirm = window.confirm('¿Está seguro de eliminar esta venta?');
        if (confirm) {
            document.getElementById(formId).submit();
        }
    }
</script>

<?= $this->endSection(); ?>