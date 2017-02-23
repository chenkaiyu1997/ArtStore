<?php
require_once "includes/myinclude.inc.php";
if((!isset($_GET["username"])) || (!isset($_GET["password"])) || (!isset($_GET["telephone"])) || (!isset($_GET["nickname"])) || (!isset($_GET["address"])) ){
    echo "failure";
}
else {
    $username=$_GET["username"];
    $password=$_GET["password"];
    $telephone=$_GET["telephone"];
    $address=$_GET["address"];
    $nickname=$_GET["nickname"];
    
    $sql="SELECT Pass FROM customerlogon WHERE UserName='$username'";
    $res=$db->query($sql);
    if($row = $res->fetch()) {
        echo "same";
    }
    else{
        $sql = "INSERT INTO customerlogon(UserName,Pass) VALUES('$username','$password')";
        $db->exec($sql);
        $sql = "INSERT INTO customers(Email,FirstName,Address,Phone,money) VALUES('$username','$nickname','$address','$telephone',0)";
        $db->exec($sql);
        echo "success";
    }
}
$db=null;

?>