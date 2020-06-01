<?php
    //db query
    require('dbquery.php');
    $sql = "SELECT * FROM users";
    $testobject = new DBQuery($pdo, $sql, $origin);
    //print_r($testobject);
    //echo($testobject->get());
    ?> <br>
    <?php
    //csrf token
    //echo($csrf);

?>