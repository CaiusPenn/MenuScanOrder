<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/menu.css'); ?>">

<div class="menucontainer container" >
    
    <div class="row mb-4">
        <div class="col-md-6">
            <h1>Menu</h1>
        </div>
            <?php if (isset($order_id)): ?>
                <div class="col-md-6 d-md-flex justify-content-end align-items-center">
                    <a href="<?= base_url('menu/vieworder/') . $order_id ?>" class="btn btn-primary">View Order</a>
                </div>
            <?php endif; ?>
        </div>
        
    <?php foreach ($category as $cat): ?>
        <div class="row">
            <div class="col-md-12">
                <h2><?= esc($cat['category_name']) ?></h2>
                <ul class="list-group">
                    <?php foreach ($item as $it): ?>
                        <?php if ($it['category_id'] == $cat['id']): ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="item-name"><?= esc($it['item_name']) ?></span>
                                    <span class="item-price"> - $<?= esc($it['price']) ?></span>
                                    <span class="item-description"><?= esc($it['description']) ?></span>
                                </div>
                                
                                <?php if (isset($table_number)): ?>
                                    <div>
                                        <a class="btn btn-primary add-to-order" href="<?= base_url('menu/order/') . $table_number . '/' . $it['id'] . '/' . $order_id?>">Add To Order</a> 
                                    </div>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>
