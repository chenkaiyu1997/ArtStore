<!DOCTYPE html>
<html>
<head>
    <?php require_once "myhead.php";?>
    <title>Art Store-Signup</title>
 </head>
<body class="signin signup">
    <a href="home.php"><img class="signinimg" src="icon/artstore-black.png" title="logo" alt="logo"></a>
    <article class="signin signup">
        <h1>Join Art Store !</h1>
        <p class="signupslogan">Enjoy our masterpieces</p>
        <form id="signupform" class="signup" onsubmit="return register()">
            <p>E-mail</p><input type="text" class="forminput fml" name="username" id="username" oninput="checkmail()" placeholder="xxx@fudan.edu.cn" required>
            <br><p>Password</p><input type="password" class="forminput fml" name="password" id="password" oninput="checklen()" title="pass" required>
            <br><p>Pass again</p><input type="password" class="forminput fml" name="password2" id="password2" oninput="checkpwd()" title="pass" required>
            <br><p>Nick name</p><input type="text" class="forminput fml" name="nickname" id="nickname" placeholder="Chen Kaiyu" required>
            <br><p>Telephone</p><input type="text" class="forminput fml" name="telephone" id="address" placeholder="110" required>
            <br><p>Address</p><input type="text" class="forminput fml" name="address" id="address" placeholder="Shanghai,China" required>
            <br><p id="formerror" class="formerror">密码不一致！</p>
            <input type="submit" class="formbtn" value="提交注册">
        </form>
        <a href="signin.php" class="tosignup">
            已经有账号？ 点击登录 -->
        </a>
    </article>

    <?php require_once "footer.php";?>

</body>