<?php
//错误详细信息
//info 标识错误 auth 标识权限组 detail 错误原因
isset($_GET['info'])?$info = $_GET['info']:$info = NULL;
isset($_GET['auth'])?$auth = $_GET['auth']:$auth = "NULL";
//直接设置为NULL会显示空 以字符串形式赋值
isset($_GET['detail'])?$detail = $_GET['detail']:$detail = NULL;
isset($_GET['loc'])?$loc = $_GET['loc']:$loc = "NULL";
if(isset($_GET["count"])){$count = $_GET["count"];}else{$count = NULL;}
$server_addrr = NULL;
?>
<!DOCTYPE HTML>
<!--
	template adapted From Html5 UP@ajlkn
	Technology:
	    Web:    Html5 + CSS3 +JS
	    Server: PHP + Nginx + MS SQL Server
	    IDE:    Jetbrains PHP Storm + VSC
-->
<html>
<head>
    <title>登录 - 中南大学教务系统</title>
    <link rel="shortcut icon" href="favicon.ico">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
    <link rel="stylesheet" href="assets/css/font-awesome.css">
</head>
<body class="contact is-preload">
<div id="page-wrapper">

    <!-- Header -->
    <header id="header">
        <h1 id="logo">
            <a href="https://csu.edu.cn">中南大学 <span>教务系统</span></a>
        </h1>
        <nav id="nav">
            <ul>
                <li class="current">
                    <a href="/public/activate.php">账号激活</a>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Main -->
    <article id="main">

        <header class="special container">
            <i>
                <img src="./assets/csulogo.png" alt="CSU_LOGO" style=" display: block;margin: auto;width:84px;"/>
            </i>
            <h2>统一身份认证登录</h2>
        </header>

        <!-- One -->
        <section class="wrapper style4 special container medium">

            <!-- Content -->
            <div class="content">
                <form action="./php_service/auth_query.php" method="post">
                    <div class="row gtr-50">
                        <div class="col-3"></div>
                        <div class="col-6">
                            <input type="text" name="username" placeholder="用户名" />
                        </div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                        <div class="col-6">
                            <input type="password" name="password" placeholder="密码" />
                        </div>
                        <div class="col-3"></div>
                        <div class="col-12">
                            <ul class="buttons">
                                <li><input type="submit" class="special" value="登录" /></li>
                            </ul>
                        </div>
                        <div class="col-12">
                            <?php
                            if($info == "wrong")
                            {
                                echo <<<WARN
                <div class="alert alert-danger">
                <strong>操作已被强制终止!&nbsp;&nbsp;错误发生位置:$loc</strong>
                <br>
                原因:$detail<br>
                权限组:$auth<br>
WARN;
                                if(isset($count))
                                {
                                    $f_count = 3 - $count;
                                    echo "您已尝试$count 次，剩余$f_count 次机会";
                                }
                                echo "</div>";
                            }
                            if($info == "success") {
                                echo <<<WARN
                <div class="alert alert-success">
                <strong>操作成功!&nbsp;&nbsp;操作发生位置:$loc</strong>
                <br>
                信息:$detail<br>
WARN;
                            }
                            ?>
                        </div>
                    </div>
                </form>
            </div>

        </section>

    </article>

    <!-- Footer -->
    <footer id="footer">

        <ul class="copyright">
            <li>&copy; SteamFinder</li><li>Adapted From Html5 Up</li>
        </ul>

    </footer>

</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.dropotron.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>