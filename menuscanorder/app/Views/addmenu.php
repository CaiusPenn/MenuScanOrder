<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
            <div class="mb-4"> 
                <a href="javascript:history.go(-1);" class="btn btn-secondary">Cancel</a>
            </div>  
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h2 class="text-center mb-4"><?= isset($menu) ? 'Edit Menu' : 'Add Menu' ?></h2>
                <form method="post" action="<?= base_url('menupage/addmenu' . (isset($menu) ? '/' . $menu['id'] : '')) ?>">
                    <div class="mb-3">
                        <label for="menu_name" class="form-label">Menu Name</label>
                        <input type="text" class="form-control" id="menu_name" name="menu_name" value="<?= isset($menu) ? esc($menu['menu_name']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" value="<?= isset($menu) ? esc($menu['description']) : '' ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary"><?= isset($menu) ? 'Update Menu' : 'Add Menu' ?></button>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>