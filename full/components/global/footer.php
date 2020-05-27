<footer class="footer">
    <div class="mw-1200 footer__content-wrapper">
      <div class="widget">
        <h5>Browse pages</h5>
        <ul class="regular">
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div>
      <div class="widget"> 
        <a class="brand logo" href="index.html">
          <p>Website</p>
        </a>
        <address>
          <strong>Title</strong><br />
          subtitle<br />
          content<br />
        </address>
      </div>
    </div>
    <div class="verybottom">
      <div class="span6">
        <p id="copyright">
          &copy; Website - All rights reserved
          <script>
            const bYear = 2020;
            const cYear = new Date().getFullYear();
            (bYear !== cYear) ? document.getElementById("copyright").insertAdjacentHTML('beforeend',`${bYear} - ${cYear}`) : document.getElementById("copyright").insertAdjacentHTML('beforeend',`${bYear}`);
          </script>
        </p>
      </div>
    </div>  
    </footer>
    <script src="<?= $path->rD ?>/assets/js/main.js"></script>
    <script src="<?= $path->rD ?>/assets/js/forms.js"></script>
  </body>
</html>