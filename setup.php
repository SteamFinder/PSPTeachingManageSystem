<?php
/*
 * PHPServerIP  PHP服务器地址
 * PyServerIP   Python服务器地址
 * DBType       数据库类型
 * DBVer        数据库版本
 * DBIP         数据库地址
 * DBPort       数据库端口
 * DBAdmin      数据库用户名
 * DBPassword   数据库密码
*/
$info = $_GET["info"] ?? NULL;
$status = $_GET["status"] ?? NULL;
?>
<!DOCTYPE html>
<html>
<head>
    <title>设置</title>
    <meta charset="utf-8">
    <!-- 新 Bootstrap5 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/css/bootstrap.min.css">
    <!--  popper.min.js 用于弹窗、提示、下拉菜单 -->
    <script src="https://cdn.staticfile.org/popper.js/2.9.3/umd/popper.min.js"></script>
    <!-- 最新的 Bootstrap5 核心 JavaScript 文件 -->
    <script src="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--    <style>-->
<!--        /*运动渐变色*/-->
<!--        body{-->
<!--            color: #fff;-->
<!--            background-image: linear-gradient(-->
<!--            125deg,#2c3e50,#27ae60, #54b0ef, #0077ff,#53e3fb-->
<!--            );-->
<!--            background-size: 400%;-->
<!--            animation: bgmove 20s infinite;-->
<!--        }-->
<!--        @keyframes bgmove {-->
<!--            0%{-->
<!--                background-position: 0  50%;-->
<!--            }-->
<!--            50%{-->
<!--                background-position: 100%  50%;-->
<!--            }-->
<!--            100%{-->
<!--                background-position: 0  50%;-->
<!--            }-->
<!--        }-->
<!--    </style>-->
</head>
<body>
    <div class="container">
        <div class="row">
            <br>
            <br>
            <div class="col-3"></div>
            <div class="col-6">
                <br>
                <br>
                <img src="./assets/csu_logo_transparent.png" loading="lazy" alt="csu_logo" width="200px" style="display: block; margin: auto;"/>
            </div>
            <div class="col-3"></div>
            <br>
            <br>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <form action="./php_setup/install.php" method="post">
                    <div class="row">
                        <?php
                        if($info != NULL){
                            if($status == 'success'){
                                echo "<div class=\"alert alert-success\">";
                                echo "<strong>注意! </strong>" . $info;
                                echo "</div>";
                            }else if($status == 'wrong'){
                                echo "<div class=\"alert alert-warning\">";
                                echo "<strong>注意! </strong>" . $info;
                                echo "</div>";
                            }else{
                                echo "<div class=\"alert alert-dark\">";
                                echo "<strong>注意! </strong> 提示信息无法正确显示<br>返回值参数出现错误(GET)";
                                echo "</div>";
                            }
                        }
                        ?>
                        <div class="alert alert-info">
                            <strong>提示:</strong> 无需填写http(s)://
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 mt-3">
                            <label for="PHPServerIP" class="form-label">PHP服务器地址</label>
                            <input type="text" class="form-control" id="PHPServerIP" placeholder="PHP运行所在服务器的IP" name="PHPServerIP">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 mt-3">
                            <label for="PyServerIP" class="form-label">Python服务器地址</label>
                            <input type="text" class="form-control" id="PyServerIP" placeholder="Python运行所在服务器的IP" name="PyServerIP">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3 mt-3">
                                <label for="DBType" class="form-label">数据库</label>
                                <input type="text" class="form-control" id="DBType" placeholder="Microsoft SQL Server" name="DBType" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3 mt-3">
                                <label for="DBVer" class="form-label">版本</label>
                                <input type="text" class="form-control" id="DBVer" placeholder="2019" name="DBVer" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="box" style="border-style:solid;border-color:#ced4da;border-width:1px;border-radius:.25rem;padding:25px;">
                        <div class="row">
                            <div class="col-9">
                                <div class="mb-3 mt-3">
                                    <label for="DBIP" class="form-label">数据库IP地址</label>
                                    <input type="text" class="form-control" id="DBIP" placeholder="数据库IP" name="DBIP">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3 mt-3">
                                    <label for="DBPort" class="form-label">端口</label>
                                    <input type="text" class="form-control" id="DBPort" placeholder="默认为1433" name="DBPort">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <div class="mb-3 mt-3">
                                    <label for="DBAdmin" class="form-label">数据库管理员名称</label>
                                    <input type="text" class="form-control" id="DBAdmin" placeholder="默认为sa" name="DBAdmin">
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="mb-3 mt-3">
                                    <label for="DBPassword" class="form-label">密码</label>
                                    <input type="password" class="form-control" id="DBPassword" placeholder="输入密码" name="DBPassword">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <button type="submit" class="btn btn-primary">提交设置</button>
                    </div>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row">
            <br>
        </div>
    </div>
</body>
</html>