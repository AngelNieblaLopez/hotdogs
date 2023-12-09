<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Datos venta
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('sellers') ?>" class="btn btn-primary">Regresar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Datos venta</h5>
                        <div class="form-group mb-3">
                            <label clas="form-label">Cliente</label>
                            <input type="text" class="form-control" disabled value="<?= trim($order["customer_user_name"]) ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Trabajador</label>
                            <input type="text" class="form-control" disabled value="<?= trim($order["seller_user_name"]) ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Taxes</label>
                            <input type="text" class="form-control" disabled value="<?= trim($order["order_taxes"]) ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Subtotal</label>
                            <input type="text" class="form-control" disabled value="<?= trim($order["order_subtotal"]) ?>">
                        </div>

                        <div class="form-group mb-3">
                            <label clas="form-label">Total</label>
                            <input type="text" class="form-control" disabled value="<?= trim($order["order_total"]) ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Alimentos</label>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($orderItems) > 0) :
                                        foreach ($orderItems as $orderItem) : ?>
                                            <tr>
                                                <td> <?= $orderItem['product_key'] ?> </td>
                                                <td> <?= $orderItem['order_item_total'] / $orderItem['order_item_quantity'] ?> </td>
                                                <td> <?= $orderItem['order_item_quantity'] ?> </td>
                                                <td> <?= $orderItem['order_item_total'] ?> </td>
                                            </tr>
                                        <?php endforeach;
                                    else : ?>
                                        <tr>
                                            <td colspan="4">
                                                <h6 class="text-danger text-center">No se encontraron alimentos</h6>
                                            </td>
                                        </tr>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>