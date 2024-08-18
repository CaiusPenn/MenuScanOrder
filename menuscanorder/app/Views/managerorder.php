<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Order List</h2>
        </div>
        <div>
            <a href="<?= base_url('menu/archivedorders/')  ?>" class="btn btn-primary">View Archives</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Table Number</th>
                    <th>View order</th>
                    <th>Is Completed</th>
                    <th>Archive</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($orders as $order): ?>
                <?php if ($order['archived'] == 0): ?>
                    <tr>
                        <td><?= esc($order['table_number']) ?></td>
                        <td> 
                            <a href="<?= base_url('menu/vieworder/') . $order['id'] ?>" class="btn btn-primary">View Order</a>
                        </td>
                        <td style="text-align: left;">
                            <!--<input type="checkbox" name="agree" id="agree" <?php echo ($order['is_complete'] == 1 ? 'checked' : ''); ?>> -->
                            <form action="<?= base_url('managerorder/updateorder/' . $order['id']) ?>" method="post">
                                <input type="checkbox" name="agree" id="agree" <?php echo ($order['is_complete'] == 1 ? 'checked' : ''); ?> >
                                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                <button type="submit" class="btn btn-primary">Mark as Complete</button>
                            </form>
                        </td>
                        <td>
                        <a href="<?= base_url('menu/archive/') . $order['id'] ?>" class="btn btn-primary">Archive Order</a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?= $this->endSection() ?>
