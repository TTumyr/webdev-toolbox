<div class="form-wrapper">
  <form action="<?= $cfg->rD ?>/register" method="POST" class="form" id="regform">
    <h2>Register Form</h2>
    <input type="hidden" name="csrf" id="csrf" value="<?=$csrf?>">
    <div class="form-control">
      <label for="username">Username</label>
      <input type="text" name="username" id="username" autocomplete="off" />
      <span class="text-danger" id="usererror"><small><?php if (isset($nameError)) echo $nameError; ?></small></span>
    </div>
    <div class="form-control group">
      <label for="email">Email</label>
      <input type="text" name="email" id="email" autocomplete="off" />
      <!--<label for="conemail">Confirm Email</label>
      <input type="text" name="cemail" id="cemail" autocomplete="off" />-->
      <span class="text-danger" id="emailerror"><small><?php if (isset($emailError)) echo $emailError; ?></small></span>
    </div>
    <div class="form-control group">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" autocomplete="off" />
      <!--<label for="cpassword">Confirm Password</label>
      <input type="password" name="cpassword" id="cpassword" autocomplete="off" />-->
      <span class="text-danger" id="passworderror"><small><?php if (isset($passwordError)) echo $passwordError; ?></small></span>
    </div>
    <div class="form-control">
    </div>
    <button class="submit" id="regsubmit" disabled>Register</button>
  </form>
</div>
