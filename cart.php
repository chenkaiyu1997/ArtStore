<!DOCTYPE html>
<html>
<head>
    <?php require_once "myhead.php";?>
    <title>Art Store-cart</title>
</head>


<?php require_once "includes/myinclude.inc.php";?>

<body>
    <?php require_once "header.php";?>
    <section class="cart">
        <h1>Your Cart </h1>
        <?php
        $subtotal = 0;   // this will need to be changed to cart subtotal

        if(isset($_SESSION["cart"]) && count($_SESSION["cart"]->items)>0) {
            $cart=$_SESSION["cart"];
            for ($i = 0; $i < count($cart->items); $i++) {
                $subtotal += $cart->items[$i]->price;
                if($i!=0) {
                    echo "<hr>";
                }
                ?>
                <div class="cartitem">
                    <img src="art-images/works/small/<?php echo $cart->items[$i]->path; ?>.jpg">
                    <a href="detail.php?id=<?php echo $cart->items[$i]->id; ?>">
                        <h3><?php echo $cart->items[$i]->title; ?></h3></a>
                    <h5>By <a
                            href="search.php?author=<?php echo $cart->items[$i]->author; ?>"><?php echo $cart->items[$i]->author; ?></a>
                    </h5>
                    <div class="options">
                        <p>价格 <span>$<?php echo number_format($cart->items[$i]->price, 2); ?></span></p>
                        <a onclick="removeitem(<?php echo $i; ?>)">删除这件商品</a>
                        <br>
                        <a>Move to Wishlist</a>
                    </div>
                </div>
                <?php
            }

        }
        else{
            echo "<h1>Your cart is empty .</h1>";
        }
        ?>

    </section>
    <?php
        if($subtotal!=0) {
            ?>
            <section class="total">
                共计<span class="totalnum">$<?php echo number_format($subtotal,2);?></span><br>
                <a onclick="pay()">下订单</a>
            </section>
    <?php
        }
    ?>
    
    <?php require_once "footer.php";?>
</body>
<script>window.onload=checklogin;</script>
<script>
    document.cookie="presentpos="+location.href;
</script>

</html>
    