<div class="form-wrapper">
  <form action="<?= $cfg->rD ?>/login" method="POST" class="form">
    <h2>Login Form</h2>
    <input type="hidden" name="csrf" value="<?=$csrf?>">
    <div class="form-control">
      <label for="username">Username</label>
      <input type="text" name="username" id="username" />
    </div>
    <div class="form-control">
      <label for="password">Password</label>
      <input type="text" name="password" id="password" />
    </div>
    <button class="submit">Login</button>
  </form>
</div>
