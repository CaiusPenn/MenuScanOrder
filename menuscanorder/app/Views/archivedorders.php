<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Archived Orders</h2>
        </div>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Table Number</th>
                    <th>View order</th>
                    <th>Un-Archive</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($orders as $order): ?>
                <?php if ($order['archived'] == 1): ?>
                    <tr>
                        <td><?= esc($order['table_number']) ?></td>
                        <td> 
                            <a href="<?= base_url('menu/vieworder/') . $order['id'] ?>" class="btn btn-primary">View Order</a>
                        </td>
                        <td>
                        <a href="<?= base_url('menu/archive/') . $order['id'] ?>" class="btn btn-primary">Un-Archive Order</a>
                        </td>
                        
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?= $this->endSection() ?>
