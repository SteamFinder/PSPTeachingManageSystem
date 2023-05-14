<?php
//  �����Ự
require_once 'panel_auth.php';
require 'mssql_exec_count.php';
panel_admin_auth();
$server_addrr = NULL;
header('Content-type:text/html;charset=gb2312');
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
    <title>������� - ����Ա</title>
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
        <a href="https://www.csu.edu.cn" class="logo"><strong>���ϴ�ѧ</strong> <span>����ϵͳ/����Ա</span></a>
        <nav>
            <a href="#menu">�������</a>
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
            <li><a href="panel_admin.php" class="button primary fit">ˢ��</a></li>
            <li><a href="auth_query.php?session=destroy" class="button fit">�˳���¼</a></li>
        </ul>
    </nav>

    <!-- Banner -->
    <section id="banner" class="major">
        <div class="inner">
            <header class="major">
                <h1>��ӭʹ�����ϴ�ѧ����ϵͳ</h1>
            </header>
            <div class="content">
                <p>���������ڷ��ʹ���Ա���<br />
                    ���幦����������ѡ��</p>
                <ul class="actions">
                    <li><a href="#one" class="button next scrolly">Get Started</a></li>
                </ul>
            </div>
        </div>
    </section>
<!--    ��ȫ��-->
    <section id="overview">
        <div class="inner">
            <header class="major">
                <h1>��ȫ�Ը���</h1>
            </header>
            <!-- <span class="image main"><img src="images/pic11.jpg" alt="" /></span> -->
            <p>Denied������ϵͳ��ֹ���ʣ������й�ע</p>
            <div id="OverflowText">
                <table class="table">
                    <thead>
                    <tr>
                        <th>�û���</th>
                        <th>��¼ʱ��</th>
                        <th>ʱ��</th>
                        <th>IP��ַ</th>
                        <th>��ȫ��</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $safetysql = new mssql_exec_count
                    (
                        'MSSQL-User',
                        'sa',
                        '123456',
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
            <!--��һ���ֿ�ʼ-->
            <article>
									<span class="image">
										<img src="images/pic01.jpg" alt="" />
									</span>
                <header class="major">
                    <h3><a href="javascript:window.open('<?php echo $server_addrr;?>/public/php_service/panel_admin_user.php','_blank','width=1000,height=800')">
                            �û�����
                        </a></h3>
                    <p>��ѯ�û��������Ϣ</p>
                </header>
            </article>
            <!--�ڶ����ֿ�ʼ-->
            <article>
									<span class="image">
										<img src="images/pic02.jpg" alt="" />
									</span>
                <header class="major">
                    <h3><a href="javascript:window.open('<?php echo $server_addrr;?>/public/php_service/panel_admin_class.php','_blank','width=1000,height=800')">
                            �γ̹���
                        </a></h3>
                    <p>��ѯ�γ�����Ŀγ���Ϣ</p>
                </header>
            </article>
            <article>
									<span class="image">
										<img src="images/pic03.jpg" alt="" />
									</span>
                <header class="major">
                    <h3><a href="javascript:window.open('<?php echo $server_addrr;?>/public/php2python.php?python_loc=admin_manage_student','_blank','width=1000,height=800')">
                            ѧ������
                        </a></h3>
                    <p>��ѯѧ���������Ϣ</p>
                </header>
            </article>
            <article>
									<span class="image">
										<img src="images/pic04.jpg" alt="" />
									</span>
                <header class="major">
                    <h3><a href="javascript:window.open('<?php echo $server_addrr;?>/public/php2python.php?python_loc=admin_manage_score','_blank','width=1000,height=800')">
                            �ɼ�����
                        </a></h3>
                    <p>��ѯ�ɼ��������Ϣ</p>
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