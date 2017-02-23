<!DOCTYPE html>
<html>

<head>
    <?php require_once "myhead.php";?>
    <title>Art Store-detail</title>

</head>

<?php
require_once "includes/myinclude.inc.php";
$id=426;
if(isset($_GET['id'])) {
    $id = $_GET['id'];
}
updateview($id,$db);
$a=getArtWork($id,$db);
if(!isset($a->price)) {
    header("Location: missing.html");
    exit;
}
?>

<body>

<?php require_once "header.php";?>

    <article class="detail">
        
        
        <h1 class="workname"><?php echo $a->title;?></h1>
        <h2>By <a class="author" href="search.php?author=<?php echo $a->author;?>"><?php echo $a->author;?></a></h2>
        <h2>Views: <?php echo $a->views;?></h2>
        <img class="working" src="art-images/works/large/<?php echo $a->path;?>.jpg">
        <div class="workdesc">
            <p><?php
                if($a->desc!=null) {
                    echo $a->desc;
                }
                else {
                    echo "We don't read and write poetry because it's cute. We read and write poetry because we are members of the human race. And the human race is filled with passion. And medicine, law, business, engineering, these are noble pursuits and necessary to sustain life. But poetry, beauty, romance, love, these are what we stay alive for.";
                }?></p>
            <h3 class="workprice">
                <?php
                    if($a->quantity==1) {
                        echo " <span> $";
                        echo number_format(ceil($a->price*19/11) + 200,2);
                        echo " </span> $";
                        echo number_format($a->price,2);
                }
                else {
                    echo "Out of Stock!";
                }?>
            </h3>
            <ul>
                <?php 
                    if($a->quantity!=0) {?>
                    <li id="addtocart" class="addtocart" onclick="addtocart()">ADD TO CART</li>
                <?php }?>
                <li id="heart" class="addtowish" onclick="changeheart()">ADD TO WISH LIST</li>
            </ul>
            
            <table class="workproperty">
                <tr><th colspan="2">PRODUCT DETAILS</th></tr>
                <tr>
                    <td>Date:</td>
                    <td><?php echo $a->year;?></td>
                </tr>
                <tr>
                    <td>Medium:</td>
                    <td><?php echo $a->medium;?></td>
                </tr>
                <tr>
                    <td>Dimensions:</td>
                    <td><?php echo $a->width;?> cm X <?php echo $a->height;?> cm</td>
                </tr>
                <tr>
                    <td>Home:</td>
                    <td><?php echo $a->home;?></td>
                </tr>
                <tr>
                    <td>Genres:</td>
                    <td>
                        <?php
                        for($i=0;$i<count($a->genre);$i++) {
                            echo '<a href="search.php?genre=';
                            echo $a->genre[$i];
                            echo '">';
                            echo $a->genre[$i];
                            echo '</a><br>';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Subjects:</td>
                    <td>
                        <?php
                        for($i=0;$i<count($a->subject);$i++) {
                            echo '<a href="search.php?subject=';
                            echo $a->subject[$i];
                            echo '">';
                            echo $a->subject[$i];
                            echo '</a><br>';                      }
                        ?>

                    </td>
                </tr>
            </table>
        </div>
        <aside class="detail">
            <ul>
                <li>热门艺术家</li>
                <hr>
                <li><a href="search.php?author=Picasso">Picasso</a></li>
                <li><a href="search.php?author=Matisse">Matisse</a></li>
                <li><a href="search.php?author=Braque">Braque</a></li>
                <li><a href="search.php?author=David">David</a></li>
            </ul>
            <ul>
                <li>热门流派</li>
                <hr>
                <li><a href="search.php?genre=Cubism">Cubism</a></li>
                <li><a href="search.php?genre=Romanticism">Romanticism</a></li>
                <li><a href="search.php?genre=Realism">Realism</a></li>
                <li><a href="search.php?genre=Impressionism">Impressionism</a></li>
            </ul>
        </aside>
    </article>

<?php require_once "footer.php";?>
<script>
    document.cookie="presentpos="+location.href;
</script>
</body>
</html>
    