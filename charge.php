<?php

require_once "includes/myinclude.inc.php";
if(isset($_GET['money']) && isset($_SESSION['CId'])) {
    $cid = $_SESSION['CId'];
    $money = $_GET['money'];
    $db->exec("UPDATE customers SET money=money+$money WHERE CustomerID='$cid'");
    echo "success";
}
else {
    echo "error!";
}
$db=null;
?>