<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <div class="mb-4"> 
            <a href="javascript:history.go(-1);" class="btn btn-secondary">Cancel</a>
        </div>  
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h2 class="text-center mb-4"><?= isset($users) ? 'Edit User' : 'Add User' ?></h2>
                <form method="post" action="<?= base_url('admin/adduser' . (isset($users) ? '/' . $users['id'] : '')) ?>">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= isset($users) ? esc($users['username']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_hash" class="form-label">Password</label>
                        <input type="password_hash" class="form-control" id="password_hash" name="password_hash" value="<?= isset($users) ? esc($users['password_hash']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= isset($users) ? esc($users['email']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="num_tables" class="form-label">Number of Tables</label>
                        <input type="number" class="form-control" id="num_tables" name="num_tables" value="<?= isset($users) ? esc($users['num_tables']) : '' ?>">
                    </div>
                    <button type="submit" class="btn btn-primary"><?= isset($users) ? 'Update User' : 'Add User' ?></button>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>