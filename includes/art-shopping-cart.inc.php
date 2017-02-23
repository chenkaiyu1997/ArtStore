
<div class="panel panel-primary">
   <div class="panel-heading">
      <h3 class="panel-title">Cart </h3>
   </div>
   <div class="panel-body">
       <?php
       $count=0;
       if(isset($_SESSION["cart"])) {
           $cart=$_SESSION["cart"];
           for($i=0;$i<count($cart->items);$i++) {
               $count+=$cart->items[$i]->item->price*$cart->items[$i]->quantity;?>
       <div class="media">
           <a class="pull-left" href="#">
               <img class="media-object" style="height:50px;width: auto;" src="images/art/works/medium/<?php echo $cart->items[$i]->item->path;?>.jpg" alt="...">
           </a>
           <div class="media-body">
               <p class="cartText"><a href="display-art-work.php?id=<?php echo $cart->items[$i]->item->id; ?>"><?php echo $cart->items[$i]->item->title;?></a></p>
           </div>
       </div>
<?php
       }
       }
?>
      <strong class="cartText">Subtotal: <span class="text-warning">$<?php echo $count;?></span></strong>
      <div>
      <button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-info-sign"></span> Edit</button>
      <button type="button" class="btn btn-primary btn-xs"><a style="text-decoration: none;color:white" href="chapter13-project02.php"><span class="glyphicon glyphicon-arrow-right"></span> Checkout</a></button>
      </div>
   </div>
</div>    