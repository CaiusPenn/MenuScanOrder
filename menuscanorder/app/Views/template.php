<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Menu Scan Order</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link href="<?= base_url('css/template.css'); ?>" rel="stylesheet">
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-custom">
      <div class="container">
        <a class="navbar-brand" href="#">MenuScanOrder</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link <?= service('router')->getMatchedRoute()[0] == '/' ? 'active' : ''; ?>" href="<?= base_url(); ?>">Home</a>
            </li>
            <?php if (session()->get('is_logged_in')): ?>
              <?php if (session()->get('is_admin')): ?>
                <li class="nav-item">
                  <a class="nav-link <?= service('router')->getMatchedRoute()[0] == 'admin' ? 'active' : ''; ?>" href="<?= base_url("admin"); ?>">Admin Panel</a>
                </li>
              
              <?php else: ?>
                <li class="nav-item">
                  <a class="nav-link <?= service('router')->getMatchedRoute()[0] == 'menupage' ? 'active' : ''; ?>" href="<?= base_url("menupage"); ?>">Menus</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?= service('router')->getMatchedRoute()[0] == 'managerorder' ? 'active' : ''; ?>" href="<?= base_url("managerorder"); ?>">Orders</a>
                </li>
              <?php endif; ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url("logout"); ?>">Logout</a>
              </li>
            <?php else: ?>
              <li class="nav-item">
                <a class="nav-link <?= service('router')->getMatchedRoute()[0] == 'login' ? 'active' : ''; ?>" href="<?= base_url("login"); ?>">Login/SignUp</a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <?= $this->renderSection('content') ?> 
  </main>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <p>&copy; <?= date('Y') ?> MenuScanOrder. All rights reserved.</p>
        </div>
        <div class="col-md-6 text-md-end">
          <a href="#">Privacy Policy</a>
          <a href="#">Terms of Service</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous"></script>
</body>
</html>
