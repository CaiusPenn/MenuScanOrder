<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
            <div class="mb-4"> 
                <a href="javascript:history.go(-1);" class="btn btn-secondary">Cancel</a>
            </div> 
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h2 class="text-center mb-4"><?= isset($category) ? 'Edit Catetgory' : 'Add Category' ?></h2>
                <form method="post" action="<?= base_url('itempage/addcategory' . (isset($category) ? '/' . $category['id'] : '')) ?>">
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="cateogry_name" name="category_name" value="<?= isset($category) ? esc($category['category_name']) : '' ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary"><?= isset($category) ? 'Update Category' : 'Add Category' ?></button>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>