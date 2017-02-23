
<?php
require_once "includes/myinclude.inc.php";
$page=1;
if(isset($_GET['page'])) {
    $page = $_GET['page'];
}

if(isset($_SESSION["a"])) {
    $a=$_SESSION["a"];
}
else {
    echo "<h1>No result found...</h1>";
}

$pagea=array();
for($i=($page-1)*6;$i<$page*6;$i++) {
    if(isset($a[$i])) {
        $pagea[] = $a[$i];
    }
}

$pageres=getArtWorks($pagea, $db);
for($row=1;$row<=2;$row++) {
    echo "<div class=\"searchshowrow$row\">";
    for($i=0;$i<3;$i++) {
        $now = ($row - 1) * 3 + $i;
        if(isset($pageres[$now])) {
            ?>
            <div class="searchshow">
                <img src="art-images/works/small/<?php echo $pageres[$now]->path; ?>.jpg">
                <h3><?php echo $pageres[$now]->title; ?></h3>
                <h5>By <?php echo $pageres[$now]->author; ?></h5>
                <div class="para"><?php echo $pageres[$now]->desc; ?></div>
                <a href="detail.php?id=<?php echo $pageres[$now]->id; ?>">了解更多</a>
                <div class="searchshowfooter">
                    <span class="money">$<?php echo number_format($pageres[$now]->price,2); ?></span>
                    <span class="deals">Views:<?php echo $pageres[$now]->views; ?></span>
                </div>
            </div>
            <?php
        }
    }
    echo "</div>";
}
$db=null;
?>