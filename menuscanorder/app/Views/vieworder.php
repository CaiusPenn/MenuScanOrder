<?= $this->extend('template') ?>
<?= $this->section('content') ?>


<section class="py-5">
    <div class="container">
        <?php if (!session()->get('is_logged_in')): ?>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="<?= base_url('menu/b/order/' . $table_number .'/'. $ret_id .'/'. $order_id ) ?>"  class="btn btn-secondary">Back</a>
            </div>
        <?php endif; ?>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Order View</h2>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Items</th>
                    <th>Price</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($placed_items as $item): ?>
                    <tr>
                        <td><?= esc($item['item_name']) ?></td>
                        <td><?= esc("$" . $item['item_price']) ?></td>
                        <td>
                            <a class="btn btn-sm btn-danger me-2" href="<?= base_url('menu/placeditemdelete/' . $item['id'] .'/'. $order_id) ?>" class="btn btn-sm btn-danger" 
                                onclick="return confirm('Delete this item from your order?')"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if (!session()->get('is_logged_in')): ?>
            <div class="text-center mt-4">
                <a href="<?= base_url('menu/confirmorder/' . $order_id) ?>" class="btn btn-primary">Confirm Order</a>
            </div>
        <?php endif; ?>
    </div>
</section>


<?= $this->endSection() ?>