<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/login.css'); ?>">


<div class="login-wrap">
  <div class="login-html">

    
    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label>
    <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
    <div class="login-form">
      <form class="sign-in-htm" method="post" action="<?= base_url('login/signin') ?>">
        <div class="group">
          <label for="username" class="label">Username</label>
          <input id="username" name="username" type="text" class="input">
        </div>
        <div class="group">
          <label for="password" class="label">Password</label>
          <input id="password" name="password" type="password" class="input" data-type="password">
        </div>
        <div class="group">
          <input type="submit" class="button" value="Sign In">
        </div>
        <div class="hr"></div>
      </form>


      <form class="sign-up-htm" method="post" action="<?= base_url('login/createuser') ?>">
        <div class="group">
          <label for="username" class="label">Username</label>
          <input id="username" name="username" type="text" class="input" required>
        </div>
        <div class="group">
          <label for="password_hash" class="label">Password</label>
          <input id="password_hash" name="password_hash" type="password" class="input" data-type="password">
        </div>
        <div class="group">
          <label for="password_confirm" class="label">Repeat Password</label>
          <input id="password_confirm" name="password_confirm" type="password" class="input" data-type="password">
        </div>
        <div class="group">
          <label for="email" class="label">Email Address</label>
          <input id="email" name="email" type="text" class="input" required>
        </div>
        <div class="group">
          <label for="num_tables" class="label">Number of Tables</label>
          <input id="num_tables" name="num_tables" type="number" class="input" required>
        </div>
        <div class="group">
          <input type="submit" class="button" value="Sign Up">
        </div>
        <div class="hr"></div>
        <div class="foot-lnk">
          <label for="tab-1">Already Member?</a>
        </div>
      </form>

    </div>
  </div>
</div>


<?= $this->endSection() ?>