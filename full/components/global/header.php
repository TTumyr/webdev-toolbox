  <body>
    <header class="header">
      <div class="header__wrapper mw-1200">
        <div class="header__logo">
          <h1>Website</h1>
        </div>
        <nav class="navbar">
          <div class="navbar__icon-wrapper">
            <div class="navbar__icon" id="navbar__icon">
              <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
          </div>
          <div class="navbar__menu" id="navbar__menu">
            <ul>
              <li class="<?= $pgID === 1 ? 'active' : '' ?>">
                <a href="/">Home</a>
              </li>
              <li class="<?= $pgID === 2 ? 'active' : '' ?>">
                <a href="/about">About</a>
              </li>
              <li class="<?= $pgID === 3 ? 'active' : '' ?>">
                <a href="/contact">Contact</a>
              </li>
              <?php if($_SESSION['auth'] == true && $_SESSION['admin'] == true) { 
                echo('<li class="');
                echo($pgID === 4 ? 'active' : '');
                echo('"><a href="/admin">Admin</a></li>'); } ?>
            </ul>
          </div>
        </nav>
              <?php if($_SESSION['auth'] == false) { echo('<button class="header__login"><a href="/login">Login</a></button>'); } else if($_SESSION['auth'] == true) { /*echo('<div class="header__login"><p>Logged in</p></div');*/
              require(dirname(__DIR__,2) . '/components/global/userloginmenu.php');
               } ?>
      </div>
    </header>