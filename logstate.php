<?php
require_once "includes/myinclude.inc.php";
if(isset($_SESSION["name"])) {
    $name = $_SESSION["name"];
    ?>
    <li id="logstate1"><a href="account.php"><span class="fa fa-user"></span><span class= "username" id="usernamespan"> <?php echo $name; ?></span></a></li>
    <?php
}
else {
    echo '<li id="logstate0">请<span><a href="signin.php"> 登录 </a></span>或者<span><a href="signup.php"> 注册 </a></span></li>';
}
?>