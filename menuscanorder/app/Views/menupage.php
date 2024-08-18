<?= $this->extend('template') ?>
<?= $this->section('content') ?>
 
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Menu page</h2>
            </div>

            <div class="row mb-4">
                <div class="col-md-6 text-start">
                    <a class="btn btn-primary" href="<?= base_url('menupage/addmenu');?>">Add menu</a>
                </div>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Menu Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($menus as $menu): ?>
                    <tr>
                        <td><?= esc($menu['menu_name']) ?></td>
                        <td><?= esc($menu['description']) ?></td>
                        <td>
                            <a class="btn btn-sm btn-info me-2" href="<?= base_url('itempage/'.$menu['id']);?>">Add Items</a>
                            <a class="btn btn-sm btn-info me-2" href="<?= base_url('menu/'.$menu['id']);?>">Menu View</i></a>
                            <a class="btn btn-sm btn-primary me-2" href="<?= base_url('menupage/addmenu/'.$menu['id']);?>"><i class="bi bi-pencil-fill"> Edit Name</i></a>
                            <a class="btn btn-sm btn-danger me-2" href="<?= base_url('menupage/delete/' . $menu['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this menu?')"><i class="bi bi-trash"></i></a>
                        </td>
                        <td>
                        <form action="<?= base_url('menupage/QRgenerate/' . $menu['id']); ?>" method="GET">
                            <div class="mb-3">
                                <label for="table_number" class="form-label">Enter Table Number:</label>
                                <input type="number" class="form-control" id="table_number" name="table_number" min = 1 max="<?= esc($user['num_tables']) ?>" required>
                            </div>
                            <button type="submit" class="btn btn-sm btn-info me-2">Generate QR Code</button>
                        </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>


<?= $this->endSection() ?>


