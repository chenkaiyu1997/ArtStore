<!DOCTYPE html>
<html>
<head>
    <?php require_once "myhead.php";?>
    <title>Art Store--account</title>
</head>


<?php require_once "includes/myinclude.inc.php";?>
<?php

    $cid=$_SESSION['CId'];
    if(!isset($_SESSION['CId'])) {
        $cid=0;
    }
    $res=$db->query("SELECT money FROM customers WHERE CustomerID=".$cid);
    $money=$res->fetch()['money'];
?>
<body>
<?php require_once "header.php";?>
<div class="account">
<section class="accountitemdiv">
    <h2>我的账户</h2>
    <p>我的余额为: $ <span class="money"><?php echo number_format($money,2);?></span></p>
    <form class="charge" onsubmit="return charge()">
        <p class="inp">充值:</p>
        <input title="money" value="100" id="chargemoney" type="text" required>
        <input type="submit">
    </form>
</section>

<section class="accountitemdiv">
    <h2>我的商品:</h2>
    <hr>
    <table class="goods">
        <tr>
            <td>图片</td>
            <td>标题</td>
            <td>作者</td>
            <td>上传时间</td>
            <td>价格</td>
            <td></td>
        </tr>
        <?php
            $myworkid=findartworks("WHERE addby=$cid ", $db, 0, 500, "addtime" , "DESC");
            $mywork=getArtWorks($myworkid, $db);
            for($i=0;$i<count($mywork);$i++) {
                ?>
                <tr>
                <td><a href="detail.php?id=<?php echo $mywork[$i]->id; ?>"><img src="art-images/works/small/<?php echo $mywork[$i]->path; ?>.jpg"></a></td>
                <td><a href="detail.php?id=<?php echo $mywork[$i]->id; ?>"><?php echo $mywork[$i]->title; ?></td>
                <td><a href="search.php?author=<?php echo $mywork[$i]->author; ?>"><?php echo $mywork[$i]->author; ?></a></td>
                <td><?php echo $mywork[$i]->addtime; ?></td>
                <td> $<?php echo number_format($mywork[$i]->price,2); ?> </td>
                <td>
                    <?php if($mywork[$i]->quantity>0) {
                        ?>
                        <a href="publish.php?delete=1&id=<?php echo $mywork[$i]->id; ?>">Edit</a>
                        <br>
                        <br>
                        <a onclick="removework(<?php echo $mywork[$i]->id; ?>)">Delete</a>
                    <?php
                    }
                    else {
                        echo "已成交";
                    }?>
                </td>
                </tr>
                <?php
            } 
        ?>
    </table>
</section>

<section class="accountitemdiv">
    <h2>我的购买:</h2>
    <hr>
    <table class="orders">
        <tr>
            <td>订单号</td>
            <td>图片</td>
            <td>标题</td>
            <td>作者</td>
            <td>购买时间</td>
            <td>订单金额</td>
        </tr>
        <?php
        $myorderres=$db->query("SELECT OrderID,DateCompleted,total FROM orders WHERE CustomerID=".$cid);
        while($row=$myorderres->fetch()){
            $myorder=$row['OrderID'];$total=$row['total'];$mytime=$row['DateCompleted'];
            $orderwork=array();
            $res=$db->query("SELECT ArtWorkID FROM orderdetails WHERE OrderID=".$myorder);
            while($row=$res->fetch()) {
                $orderwork[]=$row['ArtWorkID'];
            }
            $workcount=count($orderwork);
            ?>

            <tr>
                <td rowspan="<?php echo $workcount;?>"><?php echo $myorder;?></td>
                <?php
                $tmpwork=getArtWork($orderwork[0],$db);
                ?>
                <td><a href="detail.php?id=<?php echo $tmpwork->id; ?>"><img src="art-images/works/small/<?php echo $tmpwork->path; ?>.jpg"></a></td>
                <td><a href="detail.php?id=<?php echo $tmpwork->id; ?>"><?php echo $tmpwork->title; ?></td>
                <td><a href="search.php?author=<?php echo $tmpwork->author; ?>"><?php echo $tmpwork->author; ?></a></td>
                <td rowspan="<?php echo $workcount;?>"><?php echo $mytime;?></td>
                <td rowspan="<?php echo $workcount;?>">$ <?php echo number_format($total,2);?></td>
            </tr>

            <?php
            for($i=1;$i<$workcount;$i++) {
                $tmpwork = getArtWork($orderwork[$i], $db);
                ?>
                <tr>
                    <td><a href="detail.php?id=<?php echo $tmpwork->id; ?>"><img src="art-images/works/small/<?php echo $tmpwork->path; ?>.jpg"></a></td>
                    <td><a href="detail.php?id=<?php echo $tmpwork->id; ?>"><?php echo $tmpwork->title; ?></td>
                    <td><a href="search.php?author=<?php echo $tmpwork->author; ?>"><?php echo $tmpwork->author; ?></a></td>
                </tr>
                <?php
            }
        } ?>
    </table>
</section>

<section class="accountitemdiv">
    <h2>我的卖出:</h2>
    <hr>
    <table class="sell">
        <tr>
            <td>图片</td>
            <td>标题</td>
            <td>购买时间</td>
            <td>成交价</td>
            <td>购买人</td>
            <td>电话</td>
            <td>地址</td>
        </tr>
        <?php
        $sellworkid=findartworks("WHERE addby=$cid AND quantity=0 ", $db, 0, 500, "Views" , "DESC");
        $sellwork=getArtWorks($sellworkid, $db);
        $sellorder=array();$cusid=array();$selltime=array();$sellprice=array();$cusname=array();$cusphone=array();$cusadd=array();
        for($i=0;$i<count($sellworkid);$i++) {
            $res=$db->query("SELECT OrderID,price FROM orderdetails WHERE ArtWorkID=".$sellworkid[$i]);
            $row=$res->fetch();
            $sellorder[]=$row['OrderID'];
            $sellprice[]=$row['price'];
        }

        for($i=0;$i<count($sellorder);$i++) {
            $res=$db->query("SELECT CustomerID,DateCompleted FROM orders WHERE OrderID=".$sellorder[$i]);
            $row=$res->fetch();
            $cusid[]=$row['CustomerID'];
            $selltime[]=$row['DateCompleted'];
        }

        for($i=0;$i<count($cusid);$i++) {
            $res=$db->query("SELECT FirstName,LastName,Address,Phone FROM customers WHERE CustomerID=".$cusid[$i]);
            $row=$res->fetch();
            $cusname[]=$row['FirstName']." ".$row['LastName'];
            $cusadd[]=$row['Address'];
            $cusphone[]=$row['Phone'];
        }
        for($i=0;$i<count($sellworkid);$i++) {
            ?>
            <tr>
                <td><a href="detail.php?id=<?php echo $sellwork[$i]->id; ?>"><img src="art-images/works/small/<?php echo $sellwork[$i]->path; ?>.jpg"></a></td>
                <td><a href="detail.php?id=<?php echo $sellwork[$i]->id; ?>"><?php echo $sellwork[$i]->title; ?></td>
                <td><?php echo $selltime[$i]; ?></td>
                <td> $<?php echo number_format($sellprice[$i],2); ?> </td>
                <td><?php echo $cusname[$i]; ?></td>
                <td><?php echo $cusphone[$i]; ?></td>
                <td><?php echo $cusadd[$i]; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</section>
</div>

<?php require_once "footer.php";?>
</body>
<script>window.onload=checklogin;</script>
<script>
    document.cookie="presentpos="+location.href;
</script>
</html>
