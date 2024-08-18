
<?= $this->extend('template') ?>
<?= $this->section('content') ?>

    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Management - Admin Panel</h2>
            </div>

            <div class="row mb-4">
                <div class="col-md-6 text-start">
                    <a class="btn btn-primary" href="<?= base_url('admin/adduser');?>">Add User</a>
                </div>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Number Of Tables</th>
                        <th>Actions</th>
                    </tr>
                </thead> 
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= esc($user['username']) ?></td>
                        <td><?= esc($user['email']) ?></td>
                        <td><?= esc($user['num_tables']) ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary me-2" href="<?= base_url('admin/adduser/'.$user['id']);?>"><i class="bi bi-pencil-fill"> Edit User</i></a>
                            <a class="btn btn-sm btn-danger me-2" href="<?= base_url('admin/delete/' . $user['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </section>

<?= $this->endSection() ?>