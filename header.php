
    <header>
        <a href="home.php"><img class="logo" alt="art store" src="icon/artstore-white.png"></a>
        <span class="slogan">Where Art Belongs to</span>
        <form class="search" action="search.php" method="get">
            <input type="text" name="title" placeholder="搜索...">
            <input type="submit" class="btn" value="">
        </form>
        <ul id="headerul">
            <?php require_once "logstate.php";?>
            <li><a href="publish.php"><span class="fa fa-cloud-upload"></span> 发布作品</a></li>
            <li>
                <a href="cart.php"><span class="fa fa-shopping-cart"></span> 购物车</a>
            </li>
            <?php if(isset($_SESSION["name"])) {?>
            <li>
                <a onclick="logout()"><span class="fa fa-mail-forward"></span> 注销</a>
            </li>
            <?php }?>
        </ul>
    </header>
    <?php
        if(!isset($_SESSION)){ session_start(); }
        if(isset($_SESSION["history"])) {
            for($i=0;$i<count($_SESSION["history"]);$i++) {
                if($_SESSION["history"][$i]==explode("/",$_SERVER['PHP_SELF'])[2]){
                    while($i<count($_SESSION["history"])) {
                        array_pop($_SESSION["history"]);
                    }
                }
            }
        }
        else {
            $_SESSION["history"]=array();
        }
        $_SESSION["history"][]=explode("/",$_SERVER['PHP_SELF'])[2];
    ?>
    <nav>
        <ul>
            <?php
                $myarray=array("home.php"=>"首页","search.php"=>"搜索","detail.php"=>"详情","cart.php"=>"购物车","account.php"=>"个人主页","publish.php"=>"发布");

                $hist=$_SESSION["history"];
                for($i=0;$i<count($hist);$i++) {
                    if($i!=0) {
                        echo "<li><span class=\"fa fa-arrow-right\"></span></li>";
                    }
                    if($i!=count($hist)-1) {
                        $tmp=$myarray[$hist[$i]];
                        echo "<li><a href=\"$hist[$i]\">$tmp</a></li>";
                    }
                    else {
                        $tmp=$myarray[$hist[$i]];
                        echo "<li><a class=\"active\" href=\"$hist[$i]\">$tmp</a></li>";
                    }
                }
            ?>
        </ul>
    </nav>