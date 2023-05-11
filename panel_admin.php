<?php
//  启动会话
session_start();
//  判断是否登录并鉴权
$server_addrr = "http://localhost:".$_SERVER["SERVER_PORT"];
if( isset($_SESSION["auth"])) {
    if($_SESSION["auth"] == 1)
    {
        echo "ACCESS PASS<br>";
        echo "Session Auth:" . $_SESSION["auth"] . "<br>";
    }else{
        $auth = $_SESSION["auth"];
        die("<meta http-equiv=\"refresh\" content=\"0;url=$server_addrr/php1/login.php?info=wrong&auth=$auth&detail=No Permission&loc=panel_admin\">");
    }
} else {
    die("<meta http-equiv=\"refresh\" content=\"0;url=$server_addrr/php1/login.php?info=wrong&detail=No Session Info&loc=panel_admin\">");
}
?>
<!DOCTYPE html>
<html lang="zh_cn">
<meta charset="gb2312">
<head>
    <title>中南大学教务系统 管理员</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="https://csu.edu.cn" style="color:#fff;">中南大学教务系统</a>
        </li>
    </ul>
</nav>
<div class="container">
    <!--定义第一个容器-->
    <br>
    <br>
    <div class="row">
        <div class="col-3">
            <div class="row">
                <img src="./assets/csulogo.png" alt="CSU_LOGO" style=" display: block;margin: auto;width:128px;"/>
            </div>
            <div class="row">
                <h4 style="text-align:center;"><?php echo $_SESSION["username"]; ?></h4>
                <p style="text-align:center;">权限组:<?php echo $_SESSION["auth"]; ?></p>
            </div>
        </div>
        <div class="col-9 border">
            <br>
            <h3>管理面板</h3>
            <br>
            <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#loginRecord">
                用户登录日志
            </button>


            <!-- 模态框 -->
            <div class="modal fade" id="loginRecord">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                        <!-- 模态框头部 -->
                        <div class="modal-header">
                            <h4 class="modal-title">用户登录记录</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- 模态框内容 -->
                        <div class="modal-body">
<!--                            加载表格-->
                        </div>

                        <!-- 模态框底部 -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">关闭</button>
                        </div>

                    </div>
                </div>
            </div>

            <br>
            <br>
            <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#userList">
                用户信息列表
            </button>
            <br>
            <br>
            <!-- 模态框 -->
            <div class="modal fade" id="userList">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                        <!-- 模态框头部 -->
                        <div class="modal-header">
                            <h4 class="modal-title">用户登录记录</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- 模态框内容 -->
                        <div class="modal-body">
                            <?php
                            $conn = odbc_connect('MSSQL-User', 'sa', '123456');
                            if (!$conn) {
                                exit("连接失败: " . $conn);
                            }
                            $sql = "SELECT * FROM User_Info";
                            $rs = odbc_exec($conn, $sql);
                            if (!$rs) {
                                exit("SQL 语句错误");
                            }
                            echo <<<EOD
  <table class="table table-striped table-responsive" >
  <thead>
     <tr>
     <th>Username</th>
     <th>Password</th>
     </tr>
  </thead>
  <tbody>
EOD;
                            while (odbc_fetch_row($rs))
                            {
                                $username = odbc_result($rs,"username");
                                $password = odbc_result($rs,"password");
                                echo "<tr>";
                                echo "<td>" . $username . "</td><td>" . $password . "</td>";
                                echo "</tr>";
                            }
                            odbc_close($conn);
                            echo "</tbody></table>";
                            ?>
                        </div>

                        <!-- 模态框底部 -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">关闭</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
