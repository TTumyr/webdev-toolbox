<div class="form-wrapper">
  <form action="<?= $cfg->rD ?>/register" method="POST" class="form">
    <h2>Register Form</h2>
    <input type="hidden" name="csrf" value="<?=$csrf?>">
    <div class="form-control">
      <label for="username">Username</label>
      <input type="text" name="username" id="username" />
      <span class="text-danger"><?php if (isset($nameError)) echo $nameError; ?></span>
    </div>
    <div class="form-control">
      <label for="email">email</label>
      <input type="text" name="email" id="email" />
      <span class="text-danger"><?php if (isset($emailError)) echo $emailError; ?></span>
    </div>
    <div class="form-control">
      <label for="conemail">confirm email</label>
      <input type="text" name="cemail" id="cemail" />
    </div>
    <div class="form-control">
      <label for="password">Password</label>
      <input type="text" name="password" id="password" />
      <span class="text-danger"><?php if (isset($passwordError)) echo $passwordError; ?></span>
    </div>
    <div class="form-control">
      <label for="cpassword">Confirm Password</label>
      <input type="text" name="cpassword" id="cpassword" />
    </div>
    <button class="submit">Register</button>
  </form>
</div>
