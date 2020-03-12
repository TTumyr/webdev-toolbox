<form action="<?= $cfg->rD ?>/login" method="POST">
  <input type="hidden" name="csrf" value="<?=$csrf?>">
  <label for="username">Username</label>
  <input type="text" name="username" id="username" />
  <label for="password">Password</label>
  <input type="text" name="password" id="password" />
  <button class="submit">Login</button>
</form>
