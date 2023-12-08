<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?></title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('bootstrap-5.0.2/css/bootstrap.css') ?>">
    
    <script src="<?=base_url("js/jquery.min.js")?>"></script>
     
</head>
<body>
    <div class="container-fluid py-4">
        <?= $this->renderSection('content')?>
    </div>
    <script src="<?= base_url('vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('bootstrap-5.0.2/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>