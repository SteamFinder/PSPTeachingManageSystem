<?php
$server_addrr = "http://localhost:".$_SERVER["SERVER_PORT"];
//������ϸ��Ϣ
//info ��ʶ���� auth ��ʶȨ���� detail ����ԭ��
isset($_GET['info'])?$info = $_GET['info']:$info = NULL;
//ֱ������ΪNULL����ʾ�� ���ַ�����ʽ��ֵ
isset($_GET['detail'])?$detail = $_GET['detail']:$detail = NULL;
isset($_GET['loc'])?$loc = $_GET['loc']:$loc = "NULL";
header('Content-type:text/html;charset=gb2312');
?>
<!DOCTYPE HTML>
<!--
	Twenty by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <title>�˺ż��� - ���ϴ�ѧ����ϵͳ</title>
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
            <a href="https://csu.edu.cn">���ϴ�ѧ <span>����ϵͳ</span></a>
        </h1>
        <nav id="nav">
            <ul>
                <li class="current">
                    <a href="<?php echo $server_addrr;?>/php1/login.php">ͳһ�����֤��¼</a>
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
            <h2>ѧ���˺ż���</h2>
        </header>

        <!-- One -->
        <section class="wrapper style4 special container medium">

            <!-- Content -->
            <div class="content">
                <form action="<?php echo $server_addrr;?>/php1/php_service/activate_query.php" method="post">
                    <div class="row gtr-50">
                        <div class="col-6">
                            <input type="text" name="new_username" placeholder="�û���" />
                        </div>
                        <div class="col-6">
                            <input type="password" name="new_password" placeholder="����" />
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row gtr-50">
                        <div class="col-2">
                            <input type="text" name="st_name" placeholder="����" />
                        </div>
                        <div class="col-2">
                            <input type="text" name="st_sex" placeholder="�Ա�" />
                        </div>
                        <div class="col-3">
                            <input type="text" name="cl_name" placeholder="�༶" />
                        </div>
                        <div class="col-5">
                            <input type="text" name="st_id" placeholder="ѧ��" />
                        </div>
                    </div>
                    <br>
                    <div class="row gtr-50">
                        <div class="col-12">
                            <ul class="buttons">
                                <li><input type="submit" class="special" value="�����˺�" /></li>
                            </ul>
                        </div>
                        <div class="col-12">
                            <?php
                            if($info == "wrong")
                            {
                                echo <<<WARN
                <div class="alert alert-danger">
                <strong>�����ѱ�ǿ����ֹ!&nbsp;&nbsp;������λ��:$loc</strong>
                <br>
                ԭ��:$detail<br>
WARN;
                                if(isset($count))
                                {
                                    $f_count = 3 - $count;
                                    echo "���ѳ���$count �Σ�ʣ��$f_count �λ���";
                                }
                                echo "</div>";
                            }else if($info == "success")
                            {
                                //alert-success
                                echo <<<SUCCESS
                <div class="alert alert-success">
                <strong>�����ѳɹ����</strong>
                <br>
                ��Ϣ:$detail<br>
SUCCESS;
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