<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
            <div class="mb-4"> 
                <a href="javascript:history.go(-1);" class="btn btn-secondary">Cancel</a>
            </div> 
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h2 class="text-center mb-4"><?= isset($item) ? 'Edit Item' : 'Add Item' ?></h2>
                <form method="post" action="<?= base_url('itempage/additem' . (isset($item) ? '/' . $item['id'] : '')) ?>">
                    <div class="mb-3">
                        <label for="item_name" class="form-label">Item Name</label>
                        <input type="text" class="form-control" id="item_name" name="item_name" value="<?= isset($item) ? esc($item['item_name']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" value="<?= isset($item) ? esc($item['description']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price ($)</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?= isset($item) ? esc($item['price']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select id="category_id" class="form-select" name="category_id" required>
                            <option value="">Select a category</option>
                            <?php foreach ($category as $cat): ?>
                                <option value="<?= esc($cat['id']) ?>" <?= isset($item) && $item['category_id'] == $cat['id'] ? 'selected' : '' ?>>
                                    <?= esc($cat['category_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary"><?= isset($item) ? 'Update Item' : 'Add Item' ?></button>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>