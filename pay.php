<?php

require_once "includes/myinclude.inc.php";

function removeitem($index) {
    $cart=&$_SESSION["cart"];
    for($i=$index;$i<count($cart->items)-1;$i++) {
        $cart->items[$i]=$cart->items[$i+1];
    }
    array_pop($cart->items);
}

function makeorder($db,$subtotal) {
    $cart=&$_SESSION["cart"];
    $cid=$_SESSION["CId"];
    $db->exec("INSERT INTO orders(CustomerID,DateCompleted,total) VALUES('$cid',NOW(),'$subtotal')");
    $oid=$db->lastInsertId();
    for($i=0;$i<count($cart->items);$i++) {
        $id=$cart->items[$i]->id;
        $price=$cart->items[$i]->price;
        $db->exec("INSERT INTO orderdetails(OrderID,ArtWorkID,price) VALUES('$oid','$id','$price')");
        $db->exec("UPDATE artworks SET quantity=0 WHERE ArtWorkID='$id'");
    }
}

function submoney($db,$subtotal) {
    $cid=$_SESSION["CId"];
    $db->exec("UPDATE customers SET money=money-$subtotal WHERE CustomerID='$cid'");
}


if(isset($_SESSION["cart"]) && count($_SESSION["cart"]->items)>0) {

    $cart=&$_SESSION["cart"];

    $flag=0;$subtotal=0;
    for($i=0;$i<count($cart->items);$i++) {
        $sql="SELECT quantity,MSRP FROM artworks WHERE ArtWorkID=".$cart->items[$i]->id;
        $res=$db->query($sql);
        $row=$res->fetch();
        if($row['quantity']==0) {
            removeitem($i);
            $i--;
            $flag=1;
        }
        $subtotal+=$row['MSRP'];
    }
    if($flag==0) {
        $sql="SELECT money FROM customers WHERE CustomerID=".$_SESSION["CId"];
        $res=$db->query($sql);
        $row=$res->fetch();
        if($subtotal>$row['money']) {
            echo "nomoney";
        }
        else{
            echo "success";
            makeorder($db,$subtotal);
            submoney($db, $subtotal);
            unset($_SESSION["cart"]);
        }
    }
    else {
        echo "quantity0";
    }
}
else {
    echo "noitem";
}
$db=null;
?>