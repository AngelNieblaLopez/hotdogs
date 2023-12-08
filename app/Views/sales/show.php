<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Detalle venta
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('workers') ?>" class="btn btn-primary">Regresar a ventas</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Detalle venta</h5>
                        <div class="form-group mb-3">
                            <label clas="form-label">Cliente</label>
                            <input type="text" class="form-control" disabled value="<?= trim($sale["client_user_name"])?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Trabajador</label>
                            <input type="text" class="form-control" disabled value="<?= trim($sale["worker_user_name"])?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Asientos</label>
                            <input type="text" class="form-control" disabled value="<?= trim($custom["list_seats_names"])?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Total</label>
                            <input type="text" class="form-control" disabled value="<?= trim($sale["payment_info_total"])?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Taxes</label>
                            <input type="text" class="form-control" disabled value="<?= trim($sale["payment_info_taxes"])?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Subtotal</label>
                            <input type="text" class="form-control" disabled value="<?= trim($sale["payment_info_subtotal"])?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Estatus de pago</label>
                            <input type="text" class="form-control" disabled value="<?= trim($sale["payment_info_status_name"])?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>