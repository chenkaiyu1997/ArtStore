<!DOCTYPE html>
<html>
<head>
    <?php require_once "myhead.php";?>
    <title>Art Store</title>

    
</head>
<?php require_once "includes/myinclude.inc.php";?>

<body>

<?php
    $a=getArtWorks(findartworks("WHERE quantity>0 ",$db,0,5),$db);
    $b=getArtWorks(findartworks("WHERE quantity>0 ",$db,0,4,"addtime","DESC"),$db);
?>

<?php require_once "header.php";?>

    
    <section class="home">
        <div id="leftdiv"></div>
        <div id="frontdiv"></div>
        <div id="rightdiv"></div>
        <div class="imgleft" onclick="leftone()"></div>
        <div class="imgright" onclick="rightone()"></div>
        <?php
            for($i=1;$i<=5;$i++) {
                echo "<div id=\"i$i\" class=\"ye\" style=\"display: none\">";
                ?>
                <div class="inside" style="background-image: url(art-images/works/large/<?php echo $a[$i-1]->path;?>.jpg)">
                    <h3 class="showh3"><a href="detail.php?id=<?php echo $a[$i-1]->id;?>"><?php echo $a[$i-1]->title;?></a></h3>
                    <p class="showp"><a href="detail.php?id=<?php echo $a[$i-1]->id;?>"><?php echo $a[$i-1]->desc;?></a></p>
                </div>
                <?php echo "</div>";?>
        <?php
           }
        ?>

    </section>
        <ul class="pagedots">
            <li><a id="d1" class="active" onclick="breakctrl(1)">&#8226;</a></li>
            <li><a id="d2" onclick="breakctrl(2)">&#8226;</a></li>
            <li><a id="d3" onclick="breakctrl(3)">&#8226;</a></li>
            <li><a id="d4" onclick="breakctrl(4)">&#8226;</a></li>
            <li><a id="d5" onclick="breakctrl(5)">&#8226;</a></li>
        </ul>
    
    <article class="home">
        <h2>Recently Added Masterpieces</h2>
        <hr>
        <?php
            for($i=0;$i<4;$i++){
                ?>
        <div class="best-seller">
            <a href="detail.php?id=<?php echo $b[$i]->id;?>">
                <img src="art-images/works/small/<?php echo $b[$i]->path;?>.jpg">
                <h3><?php echo $b[$i]->title;?></h3>
                <p><?php echo $b[$i]->desc;?></p>
                <button class="learnmore">了解更多</button>
            </a>
        </div>
        <?php
            }
        ?>
    </article>

<?php require_once "footer.php";?>
<script>
    window.addEventListener('load', function(){homeonload();},20);
</script>
<script>
    document.cookie="presentpos="+location.href;
</script>
</body>
</html>