<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/confirmorder.css'); ?>">

<div class="confirmation-message">
    <h1>Order #<?= esc($order_id) ?></h1>
    <h1> Confirmed! </h1>
</div>

<?= $this->endSection() ?>
