<!DOCTYPE html>
<html>
<head>
    <?php require_once "myhead.php";?>
    <title>Art Store-Signin</title>
</head>
<body class="signin">
    
    <a href="home.php"><img class="signinimg" src="icon/artstore-black.png" title="logo" alt="logo"></a>
    <article class="signin">
        <h1>登录</h1>
        <form class="signinform" onsubmit="return login()">
            <input type="text" class="forminput" name="username" id="username" placeholder="用户名" required>
            <input type="password" class="forminput" name="password" id="password" placeholder="密码" required>
            <p id="formerror" class="formerror">该用户不存在</p>
            <input type="submit" class="formbtn" value="登录">
        </form>
        <a href="signup.php" class="forgot">忘记密码？</a>
        <a href="signup.php" class="tosignup">
            还没有账号？  现在注册 -->
        </a>
        
    </article>

    <?php
        require_once "footer.php";
    ?>
</body>