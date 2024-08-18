<?= $this->extend('template') ?>
<?= $this->section('content') ?>

    <section class="py-5">
        <div class="container"> 
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Item page</h2>
            </div>

            <div class="row mb-4">
                <div class="col-md-2 text-start">
                    <a class="btn btn-primary" href="<?= base_url('itempage/additem');?>">Add Item</a>
                </div>
            
                <div class="col-md-2 text-start">
                    <a class="btn btn-primary" href="<?= base_url('itempage/addcategory');?>">Add Category</a>
                </div>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($category as $cat): ?>
                    <tr>
                        <td><?= esc($cat['category_name']) ?></td>
                        <td>
                            <a class="btn btn-sm btn-danger me-2" href="<?= base_url('itempage/category/delete/' . $cat['id']) ?>" class="btn btn-sm btn-danger" 
                                onclick="return confirm('Are you sure you want to delete this item?')"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($item as $it): ?>
                        <tr>
                            <td><?= esc($it['item_name']) ?></td>
                            <td><?= esc($it['description']) ?></td>
                            <td><?= esc($it['category_name']) ?></td>
                            <td><?= esc( '$'. $it['price']) ?></td>
                            <td>
                                <a class="btn btn-sm btn-primary me-2" href="<?= base_url('itempage/additem/'.$it['id']);?>"><i class="bi bi-pencil-fill"> Edit Item</i></a>
                                <a class="btn btn-sm btn-danger me-2" href="<?= base_url('itempage/delete/' . $it['id']) ?>" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('Are you sure you want to delete this item?')"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

<?= $this->endSection() ?>
