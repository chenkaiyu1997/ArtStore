<?php
/**
 * Created by PhpStorm.
 * User: justryit
 * Date: 16/5/22
 * Time: 15:55
 */
require_once 'dbconfig.inc.php';
require_once 'getArtWork.inc.php';
require_once 'ArtWork.class.php';
require_once 'getArtWork.inc.php';
require_once 'ShoppingCart.class.php';
require_once 'updatedata.php';
if(!isset($_SESSION)){ session_start(); }

function getparam($type,$content,$sortbystr,$ad) {
    return $type."=".$content."&sortbystr=".$sortbystr."&ad=".$ad;
}

?>
