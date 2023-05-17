<?php
//  启动会话
require_once 'panel_auth.php';
panel_admin_auth();
$server_addrr = NULL;
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
    $query_auth = -1;
}
if(isset($_POST["add_username"]))
{
    $add_username = $_POST["add_username"];
}else{
    $add_username = NULL;
}
if(isset($_POST["add_password"]))
{
    $add_password = md5($_POST["add_password"]);
    //此处用MD5函数加密 插入进数据库直接为MD5摘要
}else{
    $add_password = md5("123456");
    //此处用MD5函数加密 插入进数据库直接为MD5摘要 默认密码为123456
}
if(isset($_POST["add_auth"]))
{
    $add_auth = $_POST["add_auth"];
}else{
    $add_auth = 3;
}
if(isset($_POST["add_st_id"]))
{
    $add_st_id = $_POST["add_st_id"];
}else{
    $add_st_id = NULL;
}
if(isset($_POST["update_username"]))
{
    $update_username = $_POST["update_username"];
}else{
    $update_username = NULL;
}
if(!empty($_POST["update_password"]))
{
    $update_password = md5($_POST["update_password"]);
}else{
    $update_password = NULL;
}
if(isset($_GET["delete"]))
{
    $delete = $_GET["delete"];
    $delsql = new mssql_exec_count
    (
        'MSSQL-User',
        'sa',
        '123456',
        "DELETE FROM User_Info WHERE username = '$delete'"
    );
    $delsql->setConnect();
    $delsql->execData();
    $delstatus = 1;
}else{
    $delete = NULL;
    $delstatus = 0;
}
//delete
if(isset($_POST["update_auth"]))
{
    $update_auth = $_POST["update_auth"];
}else{
    $update_auth = NULL;
}
if(isset($_POST["update_st_id"]))
{
    $update_st_id = $_POST["update_st_id"];
}else{
    $update_st_id = NULL;
}
if(isset($_GET["update_username_default"]))
{
    $update_username_default = $_GET["update_username_default"];
}else{
    $update_username_default = NULL;
}
/*


 */
//if(isset($_GET["add_status"]))
//{
//    $add_status = $_GET["add_status"];
//}else{
//    $add_status = NULL;
//}
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
    <title>操作面板 - 管理员</title>
    <link rel="shortcut icon" href="favicon.ico">
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
        <a href="https://www.csu.edu.cn" class="logo"><strong>中南大学</strong> <span>教务系统/管理员/用户管理</span></a>
        <nav class="navbar">
            <a href="#one">用户管理与查询</a>
            <a href="#add_user_result">添加用户</a>
            <a href="<?php echo $server_addrr;?>/public/php_service/panel_admin_user.php" class="logo"><strong>刷新</strong></a>
        </nav>
    </header>

    <!-- Menu -->

    <!-- Main -->
    <div id="main" class="alt">
        <!--用户管理-->
        <section id="one">
            <div class="inner">
                <header class="major">
                    <h1>用户管理</h1>
                </header>
                <!-- <span class="image main"><img src="images/pic11.jpg" alt="" /></span> -->
<!--                <p>text</p>-->
                <h3>用户信息的查询与更新</h3>
                <section>
                    <form method="get" action="panel_admin_user.php#query_user_result">
                        <div class="fields">
                            <div class="field half">
                                <label for="username">用户名</label>
                                <input type="text" name="query_username" id="username" placeholder="非必填"/>
                            </div>
                            <div class="field half">
                                <label for="auth">权限组</label>
                                <select name="query_auth" id="auth">
                                    <option value="-1">- 请选择权限组（非必选） -</option>
                                    <option value="1">1 管理员</option>
                                    <option value="2">2 教师</option>
                                    <option value="3">3 学生</option>
                                </select>
                            </div>
                        </div>
                        <ul class="actions">
                            <li><input type="submit" value="查询" class="primary" /></li>
                            <li><input type="reset" value="清除" /></li>
                        </ul>
                    </form>
                </section>
                <?php
                if($delstatus == 1)
                {
                    echo "<div class=\"alert alert-success\">";
                    echo "删除用户" . $delete . "成功!" ;
                    echo "</div>";
                }
                if($query_username_status == 1 || $query_auth_status == 1)
                {
                    echo <<<EOA
                    <div id="OverflowText">
                    <div id="query_user_result"></div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>用户名</th>
                            <th>密码摘要(md5)</th>
                            <th>权限组</th>
                            <th>学号</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
EOA;
                        $usersql = new mssql_exec_count
                        (
                            'MSSQL-User',
                            'sa',
                            '123456',
                            "SELECT * FROM User_Info WHERE username = '$query_username' OR auth = '$query_auth' "
                        );
                        $usersql->setConnect();
                        $rs = $usersql->queryData(4);
                        $i = 0;
                        $j[$i] = NULL;
                        foreach($rs as $r) {
                            echo "<tr>";
                            foreach($r as $c ) {
                                echo "<td>";
                                $j[$i] = $c;
                                echo $c;
                                echo "</td>";
                                $i++;
                            }
                            $temp = $j[$i-4];
                            echo "<td>";
                            echo "<a href=\"$server_addrr/public/php_service/panel_admin_user.php?choose_userinfo_username=$temp&choose_userinfo_username_status=1#one_rec\" class=\"button primary\">修改</a>";
                            echo "</td>";
                            $i++;
                            echo "</tr>";
                        }
                       echo  "</tbody>";
                   echo "</table>";
              echo  "</div>";
              }else{
                    echo <<<EOA
                    <div id="OverflowText">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>用户名</th>
                            <th>密码摘要(md5)</th>
                            <th>权限组</th>
                            <th>学号</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
EOA;
                    $usersql = new mssql_exec_count
                    (
                        'MSSQL-User',
                        'sa',
                        '123456',
                        "SELECT * FROM User_Info"
                    );
                    $usersql->setConnect();
                    $rs = $usersql->queryData(4);
                    $i = 0;
                    $j[$i] = NULL;
                    foreach($rs as $r) {
                        echo "<tr>";
                        foreach($r as $c ) {
                            echo "<td>";
                            $j[$i] = $c;
                            echo $c;
                            echo "</td>";
                            $i++;
                        }
                        $temp = $j[$i-4];
                        echo "<td>";
                        echo "<a href=\"$server_addrr/public/php_service/panel_admin_user.php?choose_userinfo_username=$temp&choose_userinfo_username_status=1#one_rec\" class=\"button primary\">修改</a>";
                        echo "</td>";
                        $i++;
                        echo "</tr>";
                    }
                    echo  "</tbody>";
                    echo "</table>";
                    echo  "</div>";
                }
            ?>
                <br>
                <hr>
                <?php
                if($choose_userinfo_username_status == 1)
                {
                echo <<<EOF
<div class="box">
                    <p>用户
                    <strong><u>$choose_userinfo_username</u></strong>
                    的登录记录</p>
                <div class="box" id="one_rec">
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
EOF;
                            $ssafetysql = new mssql_exec_count
                            (
                                'MSSQL-User',
                                'sa',
                                '123456',
                                "SELECT * FROM User_loginRec WHERE username = '$choose_userinfo_username' ORDER BY logintime DESC"
                            );
                            $ssafetysql->setConnect();
                            $rs = $ssafetysql->queryData(5);
                            foreach($rs as $r)
                            {
                                echo "<tr>";
                                foreach($r as $c )
                                {
                                    echo "<td>";
                                    echo $c;
                                    echo "</td>";
                                }
                                echo "</tr>";
                            }
                            echo <<<EOFF
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <p>更改用户
                    <strong><u>$choose_userinfo_username</u></strong>
                    的信息</p>
                <div class="box">
                    <!--显示信息-->
EOFF;
                    $upd_conn = odbc_connect('MSSQL-User', 'sa', '123456');
                    if (!$upd_conn) {
                        exit("连接失败: " . $upd_conn);
                    }
                    $sql = "SELECT * FROM User_Info WHERE username = '$choose_userinfo_username'";
                    $rs = odbc_exec($upd_conn, $sql);
                    if (!$rs) {
                        exit("SQL 语句错误");
                    }
                    $upd_password = odbc_result($rs, "password");
                    $upd_auth = odbc_result($rs, "auth");
                    $upd_st_id = odbc_result($rs, "st_id");
?>
                    <div id="update_user_result"></div>
                    <?php
                    echo "<form method=\"post\" action=\"panel_admin_user.php?update_username_default=$choose_userinfo_username#update_user_result_info\">";
                echo <<<FORM
                    <div class="fields">
                        <div class="field half">
                            <label for="update_username">用户名</label>
                            <input type="text" readonly="readonly" name="update_username" id="update_username" placeholder="$choose_userinfo_username"/>
                        </div>
                        <div class="field half">
                            <label for="update_password">密码</label>
                            <input type="text" name="update_password" id="update_password" placeholder="MD5摘要:$upd_password"/>
                        </div>
                        <div class="field half">
                            <label for="update_st_id">学号绑定</label>
                            <input type="text" name="update_st_id" id="update_st_id" placeholder="$upd_st_id"/>
                        </div>
                        <div class="field half">
                            <label for="update_auth">权限组</label>
                            <select name="update_auth" id="update_auth">
FORM;
                                if($upd_auth == 1)
                                {
                                    echo "<option value=\"1\">1 管理员</option>";
                                    echo "<option value=\"2\">2 教师</option>";
                                    echo "<option value=\"3\">3 学生</option>";
                                    echo "<option value=\"0\">0 NULL</option>";
                                }else if($upd_auth == 2)
                                {
                                    echo "<option value=\"2\">2 教师</option>";
                                    echo "<option value=\"3\">3 学生</option>";
                                    echo "<option value=\"0\">0 NULL</option>";
                                    echo "<option value=\"1\">1 管理员</option>";
                                }else if($upd_auth == 3)
                                {
                                    echo "<option value=\"3\">3 学生</option>";
                                    echo "<option value=\"0\">0 NULL</option>";
                                    echo "<option value=\"1\">1 管理员</option>";
                                    echo "<option value=\"2\">2 教师</option>";
                                }else{
                                    echo "<option value=\"0\">0 NULL</option>";
                                    echo "<option value=\"1\">1 管理员</option>";
                                    echo "<option value=\"2\">2 教师</option>";
                                    echo "<option value=\"3\">3 学生</option>";
                                }
echo <<<INPUT
                            </select>
                        </div>
                    </div>
                    <ul class="actions">
                        <li><input type="submit" value="提交更改" class="primary" /></li>
                        <li><input type="reset" value="清除" /></li>
INPUT;
                        echo "<li><a href=\"$server_addrr/public/php_service/panel_admin_user.php?delete=$choose_userinfo_username\" class=\"button primary\">删除用户</a></li>";
                    echo "</ul>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                echo "<div id=\"update_user_result_info\"></div>";
                }
                if(isset($update_username_default))
                {
                    echo "<div class=\"alert alert-success\">";
                    echo "更新完成!受影响的信息:<br>";
                    if(!empty($update_password))
                    {
                        $updsql = new mssql_exec_count
                        (
                            'MSSQL-User',
                            'sa',
                            '123456',
                            "UPDATE User_Info SET password='$update_password' WHERE username='$update_username_default';"
                        );
                        $updsql->setConnect();
                        $updsql->execData();
                        echo "密码:$update_password<br>";
                    }
                    if(!empty($update_st_id))
                    {
                        $updsql = new mssql_exec_count
                        (
                            'MSSQL-User',
                            'sa',
                            '123456',
                            "UPDATE User_Info SET st_id='$update_st_id' WHERE username='$update_username_default';"
                        );
                        $updsql->setConnect();
                        $updsql->execData();
                        echo "学号绑定:$update_st_id<br>";
                    }
                    if(!empty($update_auth))
                    {
                        $updsql = new mssql_exec_count
                        (
                            'MSSQL-User',
                            'sa',
                            '123456',
                            "UPDATE User_Info SET auth='$update_auth' WHERE username='$update_username_default';"
                        );
                        $updsql->setConnect();
                        $updsql->execData();
                        echo "权限组:$update_auth";
                    }
                    //检验
                        echo "</div>";
                }
                            ?>
                <!--添加区开始-->
                <br>
                <br>
                <hr>
                <h3>添加信息</h3>
                <p></p>
                <div id="add_user_result"></div>
                <form method="post" action="panel_admin_user.php#add_user_result">
                    <div class="fields">
                        <div class="field half">
                            <label for="add_username">用户名</label>
                            <input type="text" name="add_username" id="add_username" placeholder="必填"/>
                        </div>
                        <div class="field half">
                            <label for="add_password">密码</label>
                            <input type="text" name="add_password" id="add_password" placeholder="非必填"/>
                        </div>
                        <div class="field half">
                            <label for="add_st_id">学号绑定</label>
                            <input type="text" name="add_st_id" id="add_st_id" placeholder="非必填"/>
                        </div>
                        <div class="field half">
                            <label for="add_auth">权限组</label>
                            <select name="add_auth" id="add_auth">
                                <option value="0">- 请选择权限组（非必选） -</option>
                                <option value="1">1 管理员</option>
                                <option value="2">2 教师</option>
                                <option value="3">3 学生</option>
                            </select>
                        </div>
                    </div>
                    <ul class="actions">
                        <li><input type="submit" value="添加" class="primary" /></li>
                        <li><input type="reset" value="清除" /></li>
                    </ul>
                </form>
                <?php
                if(isset($add_username))
                {
                    $conn = odbc_connect('MSSQL-User', 'sa', '123456');
                    if (!$conn) {
                        exit("连接失败: " . $conn);
                    }
                    $sql = "SELECT * FROM User_Info WHERE username = '$add_username'";
                    $rs = odbc_exec($conn, $sql);
                    if (!$rs) {
                        exit("SQL 语句错误");
                    }
                    $distinct_r = odbc_result($rs, "username");
                    if($distinct_r != $add_username)
                    {
                        $tsql = new mssql_exec_count
                        (
                            'MSSQL-User',
                            'sa',
                            '123456',
                            "INSERT INTO User_Info VALUES ('$add_username','$add_password','$add_auth','$add_st_id')"
                        );
                        $tsql->setConnect();
                        $tsql->execData();
//                    if(isset($return_info))
//                    {
//                        echo "<strong>WARNING</strong>";
//                    }else{
//                        $return_info = NULL;
//                    }
                        echo <<<status_success
                <div class="alert alert-success">
                    添加成功!<br>
                    用户名:$add_username <br>
                    权限组:$add_auth <br>
                    学号: $add_st_id 
                </div>
status_success;
                    }else{
                        echo <<<status_alert
                        <div class="alert alert-danger">
                            添加失败!<br>用户名$add_username 已存在
                        </div>
status_alert;
                    }
                }
                ?>
<!--                </div>-->
                <!--添加区结束-->
            </div>
        </section>



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
