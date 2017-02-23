<?php
/**
 * Created by PhpStorm.
 * User: justryit
 * Date: 16/6/1
 * Time: 13:13
 */
require_once "includes/myinclude.inc.php";

if(isset($_GET['index'])) {
    $index=$_GET['index'];
    $cart=&$_SESSION["cart"];
    for($i=$index;$i<count($cart->items)-1;$i++) {
        $cart->items[$i]=$cart->items[$i+1];
    }
    array_pop($cart->items);
}
else {
    echo "error";
}
$db=null;
?>