<?php 
    $file = json_encode(array("csrf" => $_SESSION['csrf'], "username" => "TestUser"));
    //print_r($file);

    //print_r($_SESSION) ?>
<main class="mw-1200">
    <h1>Admin page</h1>
    <?php 
    $testOutput = new User("http://localhost", $_SESSION, $file);
    $testOutput->checkStatus();
    //print_r($testOutput->DBQuery->sql);
    //print_r(json_encode($testOutput->DBQuery->data));
    ?>
</main>