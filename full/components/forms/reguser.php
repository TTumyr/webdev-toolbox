<form action="<?= $cfg->rD ?>/register" method="POST">
  <input type="hidden" name="csrf" value="<?=$csrf?>">
  <label for="username">Username</label>
  <input type="text" name="username" id="username" />
  <span class="text-danger"><?php if (isset($nameError)) echo $nameError; ?></span>
  <label for="email">email</label>
  <input type="text" name="email" id="email" />
  <span class="text-danger"><?php if (isset($emailError)) echo $emailError; ?></span>
  <label for="conemail">confirm email</label>
  <input type="text" name="cemail" id="cemail" />
  <label for="password">Password</label>
  <input type="text" name="password" id="password" />
  <span class="text-danger"><?php if (isset($passwordError)) echo $passwordError; ?></span>
  <label for="cpassword">Confirm Password</label>
  <input type="text" name="cpassword" id="cpassword" />
  <button class="submit">Register</button>
</form>
