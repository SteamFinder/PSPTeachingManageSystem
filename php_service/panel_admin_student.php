<?php
//  �����Ự
require_once 'panel_auth.php';
panel_admin_auth();
$server_addrr = "0.0.0.0:" . $_SERVER["SERVER_PORT"];
require 'mssql_exec_count.php';
header('Content-type:text/html;charset=gb2312');
if(isset($_GET["choose_userinfo_username"]))
{
    $choose_userinfo_username = $_GET["choose_userinfo_username"];
}else{
    $choose_userinfo_username = NULL;
}
if(isset($_GET["choose_userinfo_username_status"]))
{
    $choose_userinfo_username_status = $_GET["choose_userinfo_username_status"];
}else{
    $choose_userinfo_username_status = NULL;
}
$query_username_status = 0;
$query_auth_status = 0;
if(isset($_GET["query_username"]))
{
    $query_username = $_GET["query_username"];
    $query_username_status = 1;
}else{
    $query_username = "NOT INPUT";
}
if(isset($_GET["query_auth"]))
{
    $query_auth = $_GET["query_auth"];
    $query_auth_status = 1;
}else{
    $query_auth = 0;
}
//query_username
//query_auth
?>
<!DOCTYPE HTML>
<!--
	Forty by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html lang="zh_cn">
<head>
    <title>������� - ����Ա</title>
    <meta charset="gb2312" />
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
    <header id="header">
        <a href="https://www.csu.edu.cn" class="logo"><strong>���ϴ�ѧ</strong> <span>����ϵͳ</span></a>
        <nav class="navbar">
            <a href="#one">�û�����</a>
            <a href="#two">�γ̹���</a>
            <a href="#three">ѧ������</a>
            <a href="#four">�ɼ�����</a>
        </nav>
    </header>

    <!-- Menu -->

    <!-- Main -->
    <div id="main" class="alt">
        <!-- ѧ������ -->
        <section id="three">
            <div class="inner">
                <header class="major">
                    <h1>ѧ������</h1>
                </header>
                <!-- <span class="image main"><img src="images/pic11.jpg" alt="" /></span> -->
                <p>Test</p>
                <h2>ѧ����Ϣ�Ĳ�ѯ�����</h2>
                <section>
                    <form method="post" action="php">
                        <div class="fields">
                            <div class="field half">
                                <label for="name">�û���</label>
                                <input type="text" name="username" id="username" placeholder="�Ǳ���"/>
                            </div>
                            <div class="field half">
                                <label for="name">Ȩ����</label>
                                <select name="auth" id="auth">
                                    <option value="">- ��ѡ��Ȩ���飨�Ǳ�ѡ�� -</option>
                                    <option value="1">1 ����Ա</option>
                                    <option value="2">2 ��ʦ</option>
                                    <option value="3">3 ѧ��</option>
                                </select>
                            </div>
                        </div>
                        <ul class="actions">
                            <li><input type="submit" value="��ѯ" class="primary" /></li>
                            <li><input type="reset" value="���" /></li>
                        </ul>
                    </form>
                </section>
                <div id="OverflowText">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>John</td>
                            <td>Doe</td>
                            <td>john@example.com</td>
                        </tr>
                        <tr>
                            <td>Mary</td>
                            <td>Moe</td>
                            <td>mary@example.com</td>
                        </tr>
                        <tr>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                        </tr>
                        <tr>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                        </tr>
                        <tr>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                        </tr>
                        <tr>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                        </tr>
                        <tr>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                        </tr>
                        <tr>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <p>���ڶ��û�
                    <strong><u>TEST</u></strong>
                    ���в���</p>
                <div class="box">
                    <p>text</p>
                </div>
            </div>
        </section>
        <!-- �ɼ����� -->
        <section id="four">
            <div class="inner">
                <header class="major">
                    <h1>�ɼ�����</h1>
                    <h2>�ɼ��Ĳ�ѯ�����</h2>
                </header>
                <!-- <span class="image main"><img src="images/pic11.jpg" alt="" /></span> -->
                <p>Test</p>
                <section>
                    <form method="post" action="php">
                        <div class="fields">
                            <div class="field half">
                                <label for="name">�û���</label>
                                <input type="text" name="username" id="username" placeholder="�Ǳ���"/>
                            </div>
                            <div class="field half">
                                <label for="name">Ȩ����</label>
                                <select name="auth" id="auth">
                                    <option value="">- ��ѡ��Ȩ���飨�Ǳ�ѡ�� -</option>
                                    <option value="1">1 ����Ա</option>
                                    <option value="2">2 ��ʦ</option>
                                    <option value="3">3 ѧ��</option>
                                </select>
                            </div>
                        </div>
                        <ul class="actions">
                            <li><input type="submit" value="��ѯ" class="primary" /></li>
                            <li><input type="reset" value="���" /></li>
                        </ul>
                    </form>
                </section>
                <div id="OverflowText">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>John</td>
                            <td>Doe</td>
                            <td>john@example.com</td>
                        </tr>
                        <tr>
                            <td>Mary</td>
                            <td>Moe</td>
                            <td>mary@example.com</td>
                        </tr>
                        <tr>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                        </tr>
                        <tr>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                        </tr>
                        <tr>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                        </tr>
                        <tr>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                        </tr>
                        <tr>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                        </tr>
                        <tr>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <p>���ڶ��û�
                    <strong><u>TEST</u></strong>
                    ���в���</p>
                <div class="box">
                    <p>text</p>
                </div>
            </div>
        </section>
    </div>

    <!-- Contact -->
    <section id="contact">
        <div class="inner">
            <section>
                <form method="post" action="#">
                    <div class="fields">
                        <div class="field half">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" />
                        </div>
                        <div class="field half">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" />
                        </div>
                        <div class="field">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" rows="6"></textarea>
                        </div>
                    </div>
                    <ul class="actions">
                        <li><input type="submit" value="Send Message" class="primary" /></li>
                        <li><input type="reset" value="Clear" /></li>
                    </ul>
                </form>
            </section>
            <section class="split">
                <section>
                    <div class="contact-method">
                        <span class="icon solid alt fa-envelope"></span>
                        <h3>Email</h3>
                        <a href="#">information@untitled.tld</a>
                    </div>
                </section>
                <section>
                    <div class="contact-method">
                        <span class="icon solid alt fa-phone"></span>
                        <h3>Phone</h3>
                        <span>(000) 000-0000 x12387</span>
                    </div>
                </section>
                <section>
                    <div class="contact-method">
                        <span class="icon solid alt fa-home"></span>
                        <h3>Address</h3>
                        <span>1234 Somewhere Road #5432<br />
										Nashville, TN 00000<br />
										United States of America</span>
                    </div>
                </section>
            </section>
        </div>
    </section>

    <!-- Footer -->
    <footer id="footer">
        <div class="inner">
            <ul class="icons">
                <li><a href="#" class="icon brands alt fa-twitter"><span class="label">Twitter</span></a></li>
                <li><a href="#" class="icon brands alt fa-facebook-f"><span class="label">Facebook</span></a></li>
                <li><a href="#" class="icon brands alt fa-instagram"><span class="label">Instagram</span></a></li>
                <li><a href="#" class="icon brands alt fa-github"><span class="label">GitHub</span></a></li>
                <li><a href="#" class="icon brands alt fa-linkedin-in"><span class="label">LinkedIn</span></a></li>
            </ul>
            <ul class="copyright">
                <li>&copy; Untitled</li><li>Design: <a href="https://html5up.net">HTML5 UP</a></li>
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
