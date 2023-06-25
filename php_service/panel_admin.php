<?php
//  启动会话
require_once 'panel_auth.php';
require 'mssql_exec_count.php';
panel_admin_auth();
$server_addrr = NULL;
header('Content-type:text/html;charset=gb2312');
require('../php_setup/read_config.php');
$config = new read_config;
$config->readConfig();
$PHPServerIP = $config->getPHPServerIP();
$PyServerIP = $config->getPyServerIP();
$DBIP = $config->getDBIP();
$DBPort = $config->getDBPort();
$DBAdmin = $config->getDBAdmin();
$DBPassword = $config->getDBPassword();
//query_username
//query_auth
?>
<!DOCTYPE HTML>
<!--
	Forty by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <title>管理面板 - 管理员</title>
    <link rel="shortcut icon" href="favicon.ico">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
    <style>
        #OverflowText {
            padding: 15px;
            width: 100%;
            height: 400px;
            overflow: auto;
            border: 0;
        }
    </style>
</head>
<body class="is-preload">

<!-- Wrapper -->
<div id="wrapper">

    <!-- Header -->
    <header id="header" class="alt">
        <!-- 文件夹地址的效果BEGIN -->
        <a href="https://www.csu.edu.cn" class="logo"><strong>中南大学</strong></a>
        <span>
            <a href="http://202.197.75.107:8080/">教务系统</a>
            /
            <a href="/public/php_service/panel_admin.php">管理员</a>
        </span>
        <!-- 文件夹地址的效果END -->
        <nav>
            <a href="#menu">功能面板</a>
        </nav>
    </header>

    <!-- Menu -->
    <nav id="menu">
        <!--        <ul class="links">-->
        <!--            <li><a href="index.html">Home</a></li>-->
        <!--            <li><a href="landing.html">Landing</a></li>-->
        <!--            <li><a href="generic.html">Generic</a></li>-->
        <!--            <li><a href="elements.html">Elements</a></li>-->
        <!--        </ul>-->
        <ul class="actions stacked">
            <li><a href="panel_admin.php" class="button primary fit">刷新</a></li>
            <li><a href="auth_query.php?session=destroy" class="button fit">退出登录</a></li>
        </ul>
    </nav>

    <!-- Banner -->
    <section id="banner" class="major">
        <div class="inner">
            <header class="major">
                <h1>欢迎使用中南大学教务系统</h1>
                <div class="content">
                    <p>您现在正在访问管理员面板<br />
                        具体功能请在下面选择</p>
                    <ul class="actions">
                        <li><a href="#one" class="button next scrolly">Get Started</a></li>
                    </ul>
                </div>
            </header>
            <div class="content">
                <iframe src="http://202.197.75.107:8080/status" width="100%" height="350px" frameborder="0px"></iframe>
            </div>
        </div>
    </section>
    <!--    安全性-->
    <section id="overview">
        <div class="inner">
            <header class="major">
                <h1>安全性概览</h1>
            </header>
            <!-- <span class="image main"><img src="images/pic11.jpg" alt="" /></span> -->
            <p>Denied代表被系统阻止访问，请密切关注</p>
            <div id="OverflowText">
                <table class="table">
                    <thead>
                    <tr>
                        <th>用户名</th>
                        <th>登录时间</th>
                        <th>时区</th>
                        <th>IP地址</th>
                        <th>安全性</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $safetysql = new mssql_exec_count
                    (
                        'MSSQL-User',
                        $DBAdmin,
                        $DBPassword,
                        'SELECT * FROM User_loginRec ORDER BY logintime DESC'
                    );
                    $safetysql->setConnect();
                    $rs = $safetysql->queryData(5);
                    foreach($rs as $r)
                    {
                        echo "<tr>";
                        foreach($r as $c )
                        {
                            echo "<td>";
                            if($c == "Denied    ")
                            {
                                echo "<strong><u>";
                            }
                            echo $c;
                            if($c == "Denied    ")
                            {
                                echo "</u></strong>";
                            }
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <br>
    <br>
    <!-- Main -->
    <div id="main">

        <!-- One -->
        <section id="one" class="tiles">
            <!--第一部分开始-->
            <article>
									<span class="image">
										<img src="images/pic01.jpg" alt="" />
									</span>
                <header class="major">
                    <h3><a href="/public/php_service/panel_admin_user.php">
                            用户管理
                        </a></h3>
                    <p>查询用户与更改信息</p>
                </header>
            </article>
            <!--第二部分开始-->
            <article>
									<span class="image">
										<img src="images/pic02.jpg" alt="" />
									</span>
                <header class="major">
                    <h3><a href="/public/php_service/panel_admin_user.php">
                            课程管理
                        </a></h3>
                    <p>查询课程与更改课程信息</p>
                </header>
            </article>
            <article>
									<span class="image">
										<img src="images/pic03.jpg" alt="" />
									</span>
                <header class="major">
                    <h3><a href="http://202.197.75.107:8080/public/php2python.php?python_loc=admin_manage_student">
                            学生管理
                        </a></h3>
                    <p>查询学生与更改信息</p>
                </header>
            </article>
            <article>
									<span class="image">
										<img src="images/pic04.jpg" alt="" />
									</span>
                <header class="major">
                    <h3><a href="http://202.197.75.107:8080/public/php2python.php?python_loc=admin_manage_score">
                            成绩管理
                        </a></h3>
                    <p>查询成绩与更改信息</p>
                </header>
            </article>
        </section>
    </div>

    <!-- Footer -->
    <footer id="footer">
        <div class="inner">
            <ul class="copyright">
                <li>&copy; SteamFinder , Adapted From HTML5 UP</li>
                <li><i class="icon brands alt fa-php"></i>
                    <i class="icon brands alt fa-html5"></i>
                    <i class="icon brands alt fa-css3"></i>
                    <i class="icon brands alt fa-js"></i>
                    <i class="icon brands alt fa-microsoft"></i>
                    <i class="icon brands alt fa-python"></i>
                </li>
            </ul>
        </div>
    </footer>

</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>