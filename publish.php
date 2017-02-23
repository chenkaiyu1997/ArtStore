<!DOCTYPE html>
<html>
<head>
    <?php require_once "myhead.php";?>
    <title>Art Store-publish</title>
</head>
<?php require_once "includes/myinclude.inc.php";?>

<?php
require_once "includes/myinclude.inc.php";

$flag=false;
if(isset($_GET['id'])) {
    $flag=true;
    $id = $_GET['id'];
    $a = getArtWork($id, $db);

    if(isset($_GET['delete'])) {
        $db->exec("DELETE FROM artworks WHERE ArtWorkID=".$id);
        $db->exec("DELETE FROM artworkgenres WHERE ArtWorkID=".$id);
        if(isset($_GET['mode'])){
            exit;
        }
    }
}
?>

<body class="publish">
    <?php require_once "header.php";?>
    <section class="publish">
        <h1>发布作品:</h1>
        <div class="publishform">
            <form id="publishtextform" name="tf" onsubmit="return publish()">
                <p>标题 [E.g.Covered Bridge]</p>
                <input title="title" type="text" name="title" value="<?php if($flag){echo $a->title;}?>" required>
                <p>作者 [E.g.Picasso]</p>
                <input title="author" type="text" name="author" value="<?php if($flag){echo $a->author;}?>" required>
                <p>介绍</p>
                <textarea title="desc" id="textdes" name="desc" rows="4" onfocus="textonfocus()" onblur="textnotfocus()"><?php if($flag){echo $a->desc;}?></textarea>
                <p>价格（美元）[E.g.499]</p>
                <input title="price" type="number" name="price" value="<?php if($flag){echo $a->price;}?>" required>
                <p>年代 [E.g.1877]</p>
                <input type="number" name="year" value="<?php if($flag){echo $a->year;}?>" required>
                <p>尺寸（高度x宽度）[E.g. 50x50]</p>
                <input title="height" id="size1" type="number" name="height" value="<?php if($flag){echo $a->height;}?>" required>X
                <input title="width" id="size2" type="number" name="width" value="<?php if($flag){echo $a->width;}?>" required>
                <p>流派 [E.g.Realism]</p>
                <input title="genre" type="text" name="genre" value="<?php if($flag){echo $a->genre[0];}?>" required>
            </form>
            <form id="publishfileform" name="ff" onsubmit="return publish()">
                <p>图片</p>
                <input type="file" name="img" id="pubfile" <?php if(!$flag){echo "required";}?>>
                <div id="pubimgdiv">
                    <p>预览：<span id="filepath"><?php if($flag){echo $a->path;}?></span></p>
                    <img id="pubimg" style="display:none">
                </div>
                <input type="submit">
            </form>
        </div>
    </section>


    <?php require_once "footer.php";?>
    <script>
        window.addEventListener('load', function(){publishonload();},20);
        window.onload=checklogin;
    </script>
    <script>
        document.cookie="presentpos="+location.href;
    </script>
</body>
</html>
    