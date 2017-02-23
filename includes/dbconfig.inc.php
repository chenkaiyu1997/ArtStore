<?php
/**
 * Created by PhpStorm.
 * User: justryit
 * Date: 16/5/22
 * Time: 14:11
 */
$connString="mysql:host=localhost;dbname=ArtStore;charset=utf8";
$user="root";
$pass=123456;
$db=new PDO($connString,$user,$pass, array(
    PDO::ATTR_PERSISTENT => false
));
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION );
?>