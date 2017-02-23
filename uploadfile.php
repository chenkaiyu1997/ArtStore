<?php

require_once "includes/myinclude.inc.php";
$id= $_GET['id'];
$fileToMove = $_FILES['file']['tmp_name'];
$destination = "./art-images/works/large/$id.jpg";
if (move_uploaded_file($fileToMove,$destination)) {
    copy("./art-images/works/large/$id.jpg","./art-images/works/small/$id.jpg");
    echo "success";
}
else {
    echo "error";
}

$db=null;
?>