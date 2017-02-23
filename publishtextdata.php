<?php
require_once "includes/myinclude.inc.php";

$title=$_GET['title'];
$author=$_GET['author'];
$tmp=explode(" ",$author);
$firstname=$tmp[0];
if(isset($tmp[1])) {
    $lastname = $tmp[1];
}
else {
    $lastname = "";
}

$desc=$_GET['desc'];
$price=$_GET['price'];
$year=$_GET['year'];
$width=$_GET['width'];
$height=$_GET['height'];
$genre=$_GET['genre'];

$views=0;
$quantity=1;
$addby=$_SESSION["CId"];

//Artist!!!
$res=$db->query("SELECT ArtistID FROM artists WHERE FirstName='$firstname' AND LastName='$lastname'");
if($row=$res->fetch()) {
    $artistid=$row['ArtistID'];
}
else {
    $db->exec("INSERT INTO artists(FirstName,LastName) VALUES('$firstname','$lastname')");
    $artistid = $db->lastInsertId();
}

//Genre!!!
$res=$db->query("SELECT GenreID FROM genres WHERE GenreName='$genre'");
if($row=$res->fetch()){
    $genreid=$row['GenreID'];  
}
else {
    $db->exec("INSERT INTO genres(GenreName) VALUES('$genre')");
    $genreid = $db->lastInsertId();
}
$db->exec("INSERT INTO artworks(ArtistID,ImageFileName,Title,Description,YearOfWork,Width,Height,MSRP,Views,addby,addtime,quantity) VALUES($artistid,'0','$title',\"$desc\",$year,$width,$height,$price,$views,$addby,NOW(),$quantity)");
$artworkid=$db->lastInsertId();
if(!isset($_GET['filepath'])) {
    $db->exec("UPDATE artworks SET ImageFileName='$artworkid' WHERE ArtWorkID=$artworkid");
}
else {
    $pathtmp=$_GET['filepath'];
    $db->exec("UPDATE artworks SET ImageFileName='$pathtmp' WHERE ArtWorkID=$artworkid");
}
$db->exec("INSERT INTO artworkgenres(GenreID,ArtWorkID) VALUES($genreid,$artworkid)");

$db=null;
if(!isset($_GET['filepath'])) {
    echo $artworkid;
}
else {
    echo $_GET['filepath'];
}
?>
