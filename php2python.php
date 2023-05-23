<?php
//真正需要GET传入的只有python_loc 即到底要去哪个python页面
//设置SERVER地址 生产环境可替换
$server_addrr = NULL;
//启动会话
session_start();
//从session中读取username auth
if(isset($_SESSION["username"]))
{
    //读取username&auth group
    $username = $_SESSION["username"];
    $auth = $_SESSION["auth"];
    //准备一下session_id
    date_default_timezone_set("Asia/Shanghai");
    $LoginDate = date("Y/m/d G:i:s");
    $session_id = md5($username . $LoginDate);
    //准备要传递的信息 要去哪里
    //下面的auth都是从GET获取数值
    //注意: 在python程序里还要进行二次验证 无需担心GET方法的安全性问题
    if(isset($_GET["python_loc"]))
    {
        //要去的python cgi的web页面
        $python_loc = $_GET["python_loc"];
    }else{
        $python_loc = NULL;
    }
//    if(isset($_GET["session_id"]))
//    {
//        //session_id 用来区分不同用户的 由该用户username和时间的md5值组成
//        $session_id = $_GET["session_id"];
//    }else{
//        $session_id = NULL;
//    }
    //准备工作完成
}else{
    //无权限 返回login.php
    die("<meta http-equiv=\"refresh\" content=\"0;url=$server_addrr/public/login.php?info=wrong&detail=未登录的用户&loc=跨程序信息传递接口:37\">");
}
require('./php_setup/read_config.php');
$config = new read_config;
$config->readConfig();
$PHPServerIP = $config->getPHPServerIP();
$PyServerIP = $config->getPyServerIP();
$DBIP = $config->getDBIP();
$DBPort = $config->getDBPort();
$DBAdmin = $config->getDBAdmin();
$DBPassword = $config->getDBPassword();
?>
<!DOCTYPE HTML>
<html lang="zh_cn">
<head>
    <title>统一身份认证接口</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="favicon.ico">
    <!-- 新 Bootstrap5 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/css/bootstrap.min.css">
    <!--  popper.min.js 用于弹窗、提示、下拉菜单 -->
    <script src="https://cdn.staticfile.org/popper.js/2.9.3/umd/popper.min.js"></script>
    <!-- 最新的 Bootstrap5 核心 JavaScript 文件 -->
    <script src="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>
</head>
<body>
<!-- 主打的就是一个减压 php将数据准备好后 先加载页面 再进行真正的数据处理-->
    <div class="container">
        <div class="row"><br><br></div>
        <div class="row">
            <!-- 3 6 3 布局 中间显示加载条 -->
            <div class="col-3"></div>
            <div class="col-6">
                <!-- 显示加载条的区域 -->
                <!--蓝色背景卡-->
                <div class="alert alert-success rounded-pill" style="text-align: center;">
                <!-- 加载的圈圈-->
                    <br>
                    <div class="spinner-grow spinner-grow-sm text-light"></div>
                    <strong>注意!</strong> 正在与Flask通信...
                    <br>
                    <br>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>
</html>
<?php
    //将数据写入 数据库User(DSN:MSSQL-User) 表User_Interface
    //列 session_id username auth
$conn = odbc_connect('MSSQL-User', $DBAdmin, $DBPassword);
if (!$conn) {
    exit("连接失败: " . $conn);
}
$sql = "INSERT INTO User_Interface VALUES ('$session_id','$username','$auth')";
/*
注意 记得让python程序根据loc判断一下
比如admin_manage_student 是管理员才能操作的 auth必须为1(管理员) 所以此处用python程序判断auth是否==1
*/
$rs = odbc_exec($conn, $sql);
if (!$rs) {
    exit("SQL 语句错误");
}
//传入python的web页面 $python_loc用if判断一下 是去成绩管理还是学生管理 然后唤起真正的url
//TODO: Exact URL
if($python_loc == "admin_manage_student")
{
    //标记:python地址 学生管理 three
    die("<meta http-equiv=\"refresh\" content=\"0;url=http://$PyServerIP?session_id=$session_id&username=$username&auth=$auth#three\">");
}else if($python_loc == "admin_manage_score"){
    //标记:python地址 成绩管理 four
    die("<meta http-equiv=\"refresh\" content=\"0;url=http://$PyServerIP?session_id=$session_id&username=$username&auth=$auth#four\">");
}else{
    //改一下提示信息
    die("<meta http-equiv=\"refresh\" content=\"0;url=$server_addrr/public/login.php?info=wrong&detail=非法的请求&loc=跨程序信息传递接口::唤起Python程序\">");
}
//PS:读数据库的一点小问题 中文显示??? 不知道为什么
//排序规则 Chinese_PRC_CI_AS
?>