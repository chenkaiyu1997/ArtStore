<?php
require_once "includes/myinclude.inc.php";
if((!isset($_GET["username"])) || (!(isset($_GET["password"])))){
    echo "failure";
}
else {
    $username=$_GET["username"];
    $password=$_GET["password"];
    $sql="SELECT CustomerID,Pass FROM customerlogon WHERE UserName='$username'";
    $res=$db->query($sql);
    if($row = $res->fetch()) {
        if ($row['Pass'] == $password) {
            $_SESSION["name"] = $username;
            $_SESSION["CId"] = $row['CustomerID'];
            echo "success";
        }
        else {
            echo "failure";
        }
    }
    else {
        echo "failure";
    }
}
$db=null;

?>
