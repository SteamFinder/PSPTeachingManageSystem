<?php
//本文件任务
//本php负责接受login传来的账号密码进行鉴权
//
//工作流程
//login.php输入账号密码 ->
//auth_query.php验证账号密码并给予权限($_SESSION["auth"])/记录错误次数($_SESSION["count"]) ->
//auth_query.php根据权限组跳转对应的panel_权限组.php
$server_addrr = NULL;
session_start();
if(isset($_GET["session"]) && $_GET["session"] == "destroy")
{
    session_destroy();
    //销毁整个session文件
    die("<meta http-equiv=\"refresh\" content=\"0;url=$server_addrr/public/login.php?info=success&detail=您已退出登录&loc=auth_query\">");
}
if(!isset($_SESSION["count"]))
{
    $_SESSION["count"]=0;
}else{
    if($_SESSION["count"] >= 3)
    {
        die("<meta http-equiv=\"refresh\" content=\"0;url=$server_addrr/public/login.php?info=wrong&detail=Banned Session,too many tries&loc=auth_query\">");
    }
}
//防止直接访问 ↓
if(!isset($_POST["username"]) || !isset($_POST["password"]))
{
    $_SESSION["count"] = $_SESSION["count"]+1;
    $count = $_SESSION["count"];
    die("<meta http-equiv=\"refresh\" content=\"0;url=$server_addrr/public/login.php?info=wrong&detail=No Session Info&loc=auth_query&count=$count\">");
}
$username = $_POST["username"];
$password = md5($_POST["password"]);
date_default_timezone_set("Asia/Shanghai");
$LoginDate = date("Y/m/d G:i:s");
$timezone = date("e - ") . "GMT" . date("P");
$ip = $_SERVER['REMOTE_ADDR'];
$server_addrr = NULL;
//  使用MD5加密
//  启动Session
//  声明一个名为 auth 的变量，并赋空值
//  Auth Method
//  1 Admin   2 Teacher   3 Student
    $_SESSION["auth"] = NULL;
    $conn = odbc_connect('MSSQL-User', 'sa', '123456');
    if (!$conn) {
        exit("连接失败: " . $conn);
    }
    $sql = "SELECT auth FROM User_Info WHERE username = '$username' AND password = '$password'";
    $rs = odbc_exec($conn, $sql);
    if (!$rs) {
        exit("SQL 语句错误");
    }
        echo "odbc:" . odbc_result($rs, "auth") . "<br>";
        $auth = odbc_result($rs, "auth");
        echo "auth var:" . $auth . "<br>";
        echo "Success<br>";
        if ($auth == 1) {
            $_SESSION["username"] = $username;
            $_SESSION["auth"] = 1;
            echo "Session Auth:" . $_SESSION["auth"] . "admin" . "<br>";
            $sql="INSERT INTO User_loginRec (username,logintime,timezone,ip) VALUES ('$username','$LoginDate','$timezone','$ip')";
            odbc_exec($conn, $sql);
            odbc_close($conn);
            $_SESSION["count"] = 0;
            die("<meta http-equiv=\"refresh\" content=\"3;url=/public/php_service/panel_admin.php\">");
        }
        else if ($auth == 2) {
            $_SESSION["username"] = $username;
            $_SESSION["auth"] = 2;
            echo "Session Auth:" . $_SESSION["auth"] . "teacher" . "<br>";
            $sql="INSERT INTO User_loginRec (username,logintime,timezone,ip) VALUES ('$username','$LoginDate','$timezone','$ip')";
            odbc_exec($conn, $sql);
            odbc_close($conn);
            $_SESSION["count"] = 0;
            die("<meta http-equiv=\"refresh\" content=\"3;url=$server_addrr/public/php_service/panel_teacher.php\">");
        }
        else if ($auth == 3) {
            $_SESSION["username"] = $username;
            $_SESSION["auth"] = 3;
            echo "Session Auth:" . $_SESSION["auth"] . "student" . "<br>";
            $sql="INSERT INTO User_loginRec (username,logintime,timezone,ip) VALUES ('$username','$LoginDate','$timezone','$ip')";
            odbc_exec($conn, $sql);
            odbc_close($conn);
            $_SESSION["count"] = 0;
            die("<meta http-equiv=\"refresh\" content=\"3;url=$server_addrr/public/php_service/panel_student.php\">");
        }else{
            $sql="INSERT INTO User_loginRec (logintime,timezone,ip,isdeny) VALUES ('$LoginDate','$timezone','$ip','Denied')";
            odbc_exec($conn, $sql);
            odbc_close($conn);
            $_SESSION["count"] = $_SESSION["count"]+1;
            $count = $_SESSION["count"];
            die("<meta http-equiv=\"refresh\" content=\"0;url=$server_addrr/public/login.php?info=wrong&detail=Incorrect username or password&loc=user_auth&count=$count\">");
//          die("<meta http-equiv=\"refresh\" content=\"0;url=old_login.php/?info=wrong&username=$username&permisson=$auth\">");
        }