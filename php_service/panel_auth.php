<?php
//本文件任务
//本php负责所有panel的鉴权工作
//panel_权限组_auth
//
//工作流程
//login.php输入账号密码 ->
//auth_query.php验证账号密码并给予权限($_SESSION["auth"])/记录错误次数($_SESSION["count"]) ->
//auth_query.php根据权限组跳转对应的panel_权限组.php
function panel_admin_auth(): void
{
    session_start();
//  判断是否登录并鉴权
    $server_addrr = "http://localhost:" . $_SERVER["SERVER_PORT"];
    if (isset($_SESSION["auth"]))
    {
        if ($_SESSION["auth"] == 1)
        {
            $_SESSION["count"] = 0;
        } else {
            $auth = $_SESSION["auth"];
            die("<meta http-equiv=\"refresh\" content=\"0;url=$server_addrr/public/login.php?info=wrong&auth=$auth&detail=No Permission&loc=panel_admin_auth\">");
        }
    } else {
        if(!isset($_SESSION["count"]))
        {
            $_SESSION["count"] = 1;
            $count = $_SESSION["count"];
            die("<meta http-equiv=\"refresh\" content=\"0;url=$server_addrr/public/login.php?info=wrong&detail=No Session Info&loc=panel_admin_auth:22&count=$count\">");
        }else{
            if($_SESSION["count"]>=3)
            {
                die("<meta http-equiv=\"refresh\" content=\"0;url=$server_addrr/public/login.php?info=wrong&detail=Banned Session,too many tries&loc=panel_admin_auth:26\">");
            }else{
                $_SESSION["count"] = $_SESSION["count"] + 1;
                $count = $_SESSION["count"];
                die("<meta http-equiv=\"refresh\" content=\"0;url=$server_addrr/public/login.php?info=wrong&detail=No Session Info&loc=panel_admin_auth:30&count=$count\">");
            }
        }
    }
}