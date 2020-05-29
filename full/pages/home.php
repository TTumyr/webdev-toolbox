<?php
    require(dirname(__DIR__,1) . '/components/global/head.php');
    require(dirname(__DIR__,1) . '/components/global/header.php');
    require(dirname(__DIR__,1) . '/components/body/home.php');
    ?>
    <div class="forms">
        <?php
        //csrf code generation on every request
        $csrf = bin2hex(random_bytes(32));
        $_SESSION['csrf'] = $csrf;

        require(dirname(__DIR__,1) . '/components/forms/login.php');
        require(dirname(__DIR__,1) . '/components/forms/reguser.php');
        ?>
    </div>
    <?php
    require(dirname(__DIR__,1) . '/components/global/footer.php');
?>