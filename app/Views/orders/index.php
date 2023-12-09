
<?= $this->extend('layouts/base_layout');
$this->section('title'); ?> Lista de ventas <?= $this->endSection(); ?>

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
                        if (count($orders) > 0) :
                            foreach ($orders as $order) : ?>
                                <tr>
                                    <td> <?= $order['id'] ?> </td>
                                    <td> <?= $order['customer_user_name'] ?> </td>
                                    <td> <?= $order['seller_user_name'] ?> </td>
                                    <td> <?= $order['order_total'] ?> </td>
                                    <td class="d-flex">
                                        <a href="<?= base_url("orders/" . $order["id"]) ?>" class="btn btn-sm btn-info mx-1" title="Mostrar"><i class="bi bi-info-square"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach;
                        else : ?>
                            <tr>
                                <td colspan="5">
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

<?= $this->endSection(); ?>