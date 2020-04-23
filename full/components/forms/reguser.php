<div class="form-wrapper">
  <form action="<?= $cfg->rD ?>/register" method="POST" class="form" id="regform">
    <h2>Register Form</h2>
    <input type="hidden" name="csrf" id="csrf" value="<?=$csrf?>">
    <div class="form-control">
      <label for="username">Username</label>
      <input type="text" name="username" id="username" />
      <span class="text-danger" id="usererror"><small><?php if (isset($nameError)) echo $nameError; ?></small></span>
    </div>
    <div class="form-control group">
      <label for="email">Email</label>
      <input type="text" name="email" id="email" />
      <label for="conemail">Confirm Email</label>
      <input type="text" name="cemail" id="cemail" />
      <span class="text-danger" id="emailerror"><small><?php if (isset($emailError)) echo $emailError; ?></small></span>
    </div>
    <div class="form-control group">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" />
      <label for="cpassword">Confirm Password</label>
      <input type="password" name="cpassword" id="cpassword" />
      <span class="text-danger" id="passworderror"><small><?php if (isset($passwordError)) echo $passwordError; ?></small></span>
    </div>
    <div class="form-control">
    </div>
    <button class="submit" id="regsubmit">Register</button>
  </form>
</div>
