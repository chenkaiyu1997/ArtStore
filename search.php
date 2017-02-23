<!DOCTYPE html>
<html>

<head>
    <?php require_once "myhead.php";?>
    <title>Art Store-detail</title>
</head>

<?php
require_once "includes/myinclude.inc.php";

$type=1;
$content="Love";
$sortbystr="Views";
$ad="DESC";

if(isset($_GET['sortbystr'])) {
    $sortbystr = $_GET['sortbystr'];
}
if(isset($_GET['ad'])) {
    $ad = $_GET['ad'];
}
if(isset($_GET['title'])) {
    $type=0;
    $content = $_GET['title'];
    $a = findartworks("WHERE quantity>0 AND Title LIKE '%" . $content . "%' ", $db, 0, 500, $sortbystr, $ad);
}
else if(isset($_GET['desc'])) {
    $type=1;
    $content = $_GET['desc'];
    $a = findartworks("WHERE quantity>0 AND Description LIKE '%" . $content . "%' ", $db, 0, 500, $sortbystr, $ad);
}
else if(isset($_GET['author'])) {
    $type=2;
    $content = $_GET['author'];
    $a = findartworks("WHERE quantity>0 AND FirstName LIKE '%" . $content . "%'"." OR "."LastName LIKE '%" . $content . "%' ", $db, 0, 500, $sortbystr, $ad);
}
else if(isset($_GET['genre'])) {
    $type=3;
    $content = $_GET['genre'];
    $a = findartworks("WHERE quantity>0 AND GenreName LIKE '%" . $content . "%' ", $db, 0, 500, $sortbystr, $ad);
}
else if(isset($_GET['subject'])) {
    $type=4;
    $content = $_GET['subject'];
    $a = findartworks("WHERE quantity>0 AND SubjectName LIKE '%" . $content . "%' ", $db, 0, 500, $sortbystr, $ad);
}
else {
    $a = findartworks("WHERE quantity>0 AND Description LIKE '%" . $content . "%' ", $db, 0, 500, $sortbystr, $ad);
}
$_SESSION["a"]=$a;

?>


<body class="search">
    <?php require_once "header.php";?>
    <section class="search">
        <form class="search" action="search.php" method="get">
            <input title="title" type="text" name="title" value="<?php echo $content;?>">
            <input type="submit" class="btn" value="">
        </form>
        <div class="searchtypewrap">
        <div class="searchtype">
            <div class="pwrap"><p>What do you want to find ?</p></div>
            <ul>
                <?php
                    $iconarray=array("navicon","wpforms","male","tags","pencil-square-o");
                    $tmparray=array("title","desc","author","genre","subject");
                    $tmparray2=array("Title","Description","Aritist","Genre","Subject");
                    for($i=0;$i<5;$i++) {
                        if($type==$i) {
                            echo "<li><a class=\"active\" href=\"search.php?".getparam($tmparray[$i],$content,$sortbystr,$ad)."\">"."<span class=\"fa fa-".$iconarray[$i]."\"></span> ".$tmparray2[$i]." </a></li>";
                        }
                        else {
                            echo "<li><a href=\"search.php?".getparam($tmparray[$i],$content,$sortbystr,$ad)."\">"."<span class=\"fa fa-".$iconarray[$i]."\"></span> ".$tmparray2[$i]." </a></li>";
                        }
                    }
                ?>
            </ul>
        </div>
        <div class="searchtype">
            <div class="pwrap"><p>Sort By :</p></div>
            <ul>
            <?php
            $iconarray1=array("dollar","dollar","fire","fire");
            $iconarray2=array("angle-double-down","angle-double-up","angle-double-down","angle-double-up");
            $textarray=array("Price","Price","Heat","Heat");
            $sortbyarray=array("MSRP","MSRP","Views","Views");
            $adarray=array("DESC","ASC","DESC","ASC");

            for($i=0;$i<4;$i++) {
                if($ad==$adarray[$i] && $sortbystr==$sortbyarray[$i]) {
                    echo "<li><a class=\"active\" href=\"search.php?".getparam($tmparray[$type],$content,$sortbyarray[$i],$adarray[$i])."\">"."<span class=\"fa fa-".$iconarray1[$i]."\"></span> ".$textarray[$i]." <span class=\"fa fa-".$iconarray2[$i]."\"></span></a></li>";
                }
                else {
                    echo "<li><a href=\"search.php?".getparam($tmparray[$type],$content,$sortbyarray[$i],$adarray[$i])."\">"."<span class=\"fa fa-".$iconarray1[$i]."\"></span> ".$textarray[$i]." <span class=\"fa fa-".$iconarray2[$i]."\"></span></a></li>";
                }
            }
            ?>
            </ul>
        </div></div>
    </section>
    <?php
        $pagenum=ceil(count($a)/6);
    ?>
    <article class="search">
        <h1>Search result in "<?php echo $content;?>" As "<?php echo $tmparray2[$type]?>"</h1>
        <h4><?php echo count($a);?> results found ... <span id="pagenum"><?php echo $pagenum;?></span> page(s) in total</h4>
        <div class="pagediv">
            <div id="frontdiv"></div>
            <div id="leftdiv"></div>
            <div id="rightdiv"></div>
            <div id="i1" class="ye" style="display: none"><?php include "searchdiv.php"; ?></div>
            <?php
                for($i=2;$i<=$pagenum;$i++) {
                    echo "<div id=\"i$i\"  class=\"ye\" style=\"display: none\"></div>";
                }
            ?>
        </div>
        
        <div class="pag">
        <ul class="pagination">
            <li><a onclick="prevpage()">《</a></li>
            <li><a id="d1" onclick="gotopage(1)">1</a></li>
            <?php
                for($i=2;$i<=$pagenum;$i++){
                    if($i>8) {
                        echo "<li style='display: none'><a id=\"d$i\"onclick=\"gotopage($i)\">$i</a></li>";
                    }
                    else {
                        echo "<li><a id=\"d$i\"onclick=\"gotopage($i)\">$i</a></li>";
                    }
                }
            ?>
            <li><a onclick="nextpage()">》</a></li>
        </ul>
            <div id="gp">
            <p>Page:</p>
            <input type="text" id="pageinput" title="page">
            <button onclick="gotopage(0)"> Go ! </button>
            </div>
        </div>

    </article>

    
    <?php require_once "footer.php";?>
    <script>
        window.addEventListener('load', function(){searchonload();},20);
    </script>
    <script>trtime="0.5s";</script>
    <script>
        document.cookie="presentpos="+location.href;
    </script>
</body>