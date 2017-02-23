<?php
function updateview($id,$db) {
    $sql="UPDATE artworks SET Views=Views+1 WHERE ArtWorkID='$id'";
    $db->exec($sql);
}
?>