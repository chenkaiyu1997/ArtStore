<?php
/**
 * Created by PhpStorm.
 * User: justryit
 * Date: 16/6/1
 * Time: 13:13
 */
require_once "includes/myinclude.inc.php";


if(isset($_GET['id'])) {
    if(!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = new ShoppingCart(array());
    }
    $cart=&$_SESSION["cart"];

    $flag=0;
    for($i=0;$i<count($cart->items);$i++) {
        if($cart->items[$i]->id==$_GET['id']) {
            $flag=1;
            break;
        }
    }
    if($flag==0) {
        $item=getArtWork($_GET['id'],$db);
        $cart->items[]=$item;
    }
}
$db=null;

?>