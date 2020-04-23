<div class="form-wrapper">
  <form action="<?= $cfg->rD ?>/login" method="POST" class="form" id="logfrm">
    <h2>Login Form</h2>
    <input type="hidden" name="csrf" id="logcsrf" value="<?=$csrf?>">
    <div class="form-control">
      <label for="username">Username</label>
      <input type="text" name="username" id="loguser" />
    </div>
    <div class="form-control">
      <label for="password">Password</label>
      <input type="password" name="password" id="logpassword" />
    </div>
    <button class="submit">Login</button>
  </form>
</div>
