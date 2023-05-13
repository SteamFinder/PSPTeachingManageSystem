<?php
//  启动会话
require_once 'panel_auth.php';
panel_admin_auth();
$server_addrr = NULL;
require 'mssql_exec_count.php';
//这里是接收查询区的post数据 从<form>表单传递
//c_id
if(isset($_POST["query_c_id"]))
{
    $query_c_id = $_POST["query_c_id"];
}else{
    $query_c_id = NULL;
}
//c_name
if(isset($_POST["query_c_name"]))
{
    $query_c_name = $_POST["query_c_name"];
}else{
    $query_c_name = NULL;
}
//c_credit
if(isset($_POST["query_c_credit"]))
{
    $query_c_credit = $_POST["query_c_credit"];
}else{
    $query_c_credit = NULL;
}
//c_type
if(isset($_POST["query_c_type"]))
{
    $query_c_type = $_POST["query_c_type"];
}else{
    $query_c_type = NULL;
}
//
//
//
//choose_classid 点击 修改 按钮后，选定课程id
if(isset($_GET["choose_classid"]))
{
    $choose_classid = $_GET["choose_classid"];
}else{
    $choose_classid = NULL;
}
//choose_classname 跟id是一块的 传递课程名
if(isset($_GET["choose_classname"]))
{
    $choose_classname = $_GET["choose_classname"];
}else{
    $choose_classname = 2;
}
//choose_class_status 点击 修改 按钮后，选定课程id + 更新状态标识
if(isset($_GET["choose_class_status"]))
{
    $choose_class_status = $_GET["choose_class_status"];
}else{
    $choose_class_status = NULL;
}
//删除区 删除选x课的x学生
if(isset($_GET["del_stid"]))
{
    $del_stid = $_GET["del_stid"];
    $del_stid_status = 1;
}else{
    $del_stid = NULL;
    $del_stid_status = NULL;
}
//与stid一起 告诉操作者删除学生的名字
if(isset($_GET["del_stname"]))
{
    $del_stname = $_GET["del_stname"];
}else{
    $del_stname = NULL;
}
//删除的课程id
if(isset($_GET["delclassid"]))
{
    $delclassid = $_GET["delclassid"];
}else{
    $delclassid = NULL;
}
//是否点击了提交更新按钮 yes
if(isset($_GET["upd_status"]))
{
    $upd_status = $_GET["upd_status"];
}else{
    $upd_status = NULL;
}
//点击增加信息的提交按钮 yes
if(isset($_GET["add_status"]))
{
    $add_status = $_GET["add_status"];
}else{
    $add_status = NULL;
}
//
//
//POST 增加信息
if(isset($_POST["add_classid"]))
{
    $add_classid = $_POST["add_classid"];
}else{
    $add_classid = NULL;
}
if(isset($_POST["add_classname"]))
{
    $add_classname = $_POST["add_classname"];
}else{
    $add_classname = NULL;
}
if(isset($_POST["add_classtype"]))
{
    $add_classtype = $_POST["add_classtype"];
}else{
    $add_classtype = NULL;
}
if(isset($_POST["add_classdes"]))
{
    $add_classdes = $_POST["add_classdes"];
}else{
    $add_classdes = NULL;
}
if(isset($_POST["add_classcredit"]))
{
    $add_classcredit = $_POST["add_classcredit"];
}else{
    $add_classcredit = NULL;
}
//给课程添加学生
//要知道是哪个学生
if(isset($_POST["add_class_stid"]))
{
    $add_class_stid = $_POST["add_class_stid"];
}else{
    $add_class_stid = NULL;
}
//要知道是哪个课
if(isset($_POST["add_class_classid"]))
{
    $add_class_classid = $_POST["add_class_classid"];
}else{
    $add_class_classid = NULL;
}
//多少分
if(isset($_POST["add_class_score"]))
{
    $add_class_score = $_POST["add_class_score"];
}else{
    $add_class_score = NULL;
}
header('Content-type:text/html;charset=gb2312');
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
        <a href="https://www.csu.edu.cn" class="logo"><strong>中南大学</strong> <span>教务系统/管理员/课程管理</span></a>
        <nav class="navbar">
            <a href="#query">课程管理与查询</a>
            <a href="#add">添加课程</a>
            <a href="<?php echo $server_addrr;?>/public/php_service/panel_admin_class.php" class="logo"><strong>刷新</strong></a>
        </nav>
    </header>
    <!-- Main -->
        <!--用户管理-->
    <div id="main" class="alt">
        <section id="query">
            <div class="inner">
                <header class="major">
                    <h1>课程管理</h1>
                </header>
                <h2>课程信息的查询与更新</h2>
                <section>
                    <form method="post" action="panel_admin_class.php">
                        <div class="fields">
                            <div class="field half">
                                <label for="query_c_id">课程ID</label>
                                <input type="text" name="query_c_id" id="query_c_id" placeholder="非必填"/>
                            </div>
                            <div class="field half">
                                <label for="query_c_name">课程名称</label>
                                <input type="text" name="query_c_name" id="query_c_name" placeholder="非必填"/>
                            </div>
                            <div class="field half">
                                <label for="query_c_credit">学分</label>
                                <input type="text" name="query_c_credit" id="query_c_credit" placeholder="非必填"/>
                            </div>
                            <div class="field half">
                                <label for="name">类型</label>
                                <select name="query_c_type" id="query_c_type">
                                    <option value="">- 请选择课程类型（非必选） -</option>
                                    <option value="必修">必修</option>
                                    <option value="选修">选修</option>
                                </select>
                            </div>
                        </div>
                        <ul class="actions">
                            <li><input type="submit" value="查询" class="primary" /></li>
                            <li><input type="reset" value="清除" /></li>
                        </ul>
                    </form>
                </section>
                <div id="OverflowText">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>课程ID</th>
                            <th>名称</th>
                            <th>类型</th>
                            <th>学分</th>
                            <th>备注</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(isset($query_c_id) || isset($query_c_name) || isset($query_c_credit) || isset($query_c_type))
                        {
                            $querysql = new mssql_exec_count
                            (
                                'MSSQL-Student',
                                'sa',
                                '123456',
                                "SELECT * FROM C_Info WHERE C_No = '$query_c_id' OR C_Name = '$query_c_name' OR C_Type = '$query_c_type' OR C_Credit = '$query_c_credit'"
                            );
                            $querysql->setConnect();
                            $rs = $querysql->queryData(5);
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
                                $temp = $j[$i-5];
                                $temp_class_name = $j[$i-4];
                                echo "<td>";
                                echo "<a href=\"$server_addrr/public/php_service/panel_admin_class.php?choose_class_status=yes&choose_classid=$temp&choose_classname=$temp_class_name#query_extra\" class=\"button primary\">修改</a>";
                                echo "</td>";
                                $i++;
                                echo "</tr>";
                            }
                        }else{
                            $querysql = new mssql_exec_count
                            (
                                'MSSQL-Student',
                                'sa',
                                '123456',
                                "SELECT * FROM C_Info"
                            );
                            $querysql->setConnect();
                            $rs = $querysql->queryData(5);
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
                                $temp = $j[$i-5];
                                $temp_class_name = $j[$i-4];
                                echo "<td>";
                                echo "<a href=\"$server_addrr/public/php_service/panel_admin_class.php?choose_class_status=yes&choose_classid=$temp&choose_classname=$temp_class_name#query_extra\" class=\"button primary\">修改</a>";
                                echo "</td>";
                                $i++;
                                echo "</tr>";
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <?php
                if(isset($delclassid))
                {
                    echo "<div class=\"alert alert-success\">";
                    echo "删除课程成功";
                    echo "</div>";
                    $updsql = new mssql_exec_count
                    (
                        'MSSQL-Student',
                        'sa',
                        '123456',
                        "DELETE FROM C_Info WHERE C_No = '$delclassid'"
                    );
                    $updsql->setConnect();
                    $updsql->execData();
                }
                ?>
                <br>
                <!--选择后显示-->
                <?php
                //点击按钮后 更新choose_class_status =1 显示该区域
                if ($del_stid_status == 1) {
                    $delsql = new mssql_exec_count
                    (
                        'MSSQL-Student',
                        'sa',
                        '123456',
                        "DELETE FROM S_C_Info WHERE St_ID = '$del_stid'"
                    );
                    $delsql->setConnect();
                    $delsql->execData();
                    echo "<div class=\"alert alert-success\">";
                    echo "从" . $choose_classname . "中删除学生" . $del_stname . "(ID: " . $del_stid . ")" . "成功!";
                    echo "</div>";
                }
                if($choose_class_status == "yes")
                {
                    echo <<<VIEW
                <div class="box" id="query_extra">
                    <!--信息区-->
                    <p>课程&nbsp;
                        <strong><u>$choose_classname</u></strong>
                        的学生信息</p>
                    <div class="box">
                <div id="OverflowText">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>学号</th>
                            <th>姓名</th>
                            <th>性别</th>
                            <th>班级</th>
                            <th>成绩</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
VIEW;
                    $qcsql = new mssql_exec_count
                    (
                        'MSSQL-Student',
                        'sa',
                        '123456',
                        "SELECT St_Info.St_ID,St_Name,St_Sex,Cl_Name,Score FROM St_Info JOIN S_C_Info ON St_Info.St_ID = S_C_Info.St_ID WHERE C_No = '$choose_classid'"
                    );
                    $qcsql->setConnect();
                    $rs = $qcsql->queryData(5);
                        foreach($rs as $r) {
                            echo "<tr>";
                            foreach($r as $c ) {
                                echo "<td>";
                                $j[$i] = $c;
                                echo $c;
                                echo "</td>";
                                $i++;
                            }
                            $temp = $j[$i-5];
                            $temp2 = $j[$i-4];
                            echo "<td>";
                            echo "<a href=\"$server_addrr/public/php_service/panel_admin_class.php?choose_class_status=yes&del_stid=$temp&del_stname=$temp2&choose_classid=$choose_classid&choose_classname=$choose_classname#query_extra\" class=\"button primary\">删除</a>";
                            echo "</td>";
                            $i++;
                            echo "</tr>";
                        }
                        echo "</tr>";
                    echo <<<VIEW
                        </tbody>
                    </table>
                </div>
                </div>
                    <br>
                     <!--操作区-->
                    <p>对课程&nbsp;
                        <strong><u>$choose_classname</u></strong>
                        进行操作</p>
                    <div class="box">
VIEW;
                    $upd_conn = odbc_connect('MSSQL-Student', 'sa', '123456');
                    if (!$upd_conn) {
                        exit("连接失败: " . $upd_conn);
                    }
                    $sql = "SELECT * FROM C_Info WHERE C_No = '$choose_classid'";
                    $rs = odbc_exec($upd_conn, $sql);
                    if (!$rs) {
                        exit("SQL 语句错误");
                    }
                    $upd_C_No = odbc_result($rs, "C_No");
                    $upd_C_Name = odbc_result($rs, "C_Name");
                    $upd_C_Credit = odbc_result($rs, "C_Credit");
                    $upd_C_Type = odbc_result($rs, "C_Type");
                    $upd_C_Des = odbc_result($rs, "C_Des");
                    echo "<form method=\"post\" action=\"panel_admin_class.php#update_info?upd_status=yes&choose_classid=$choose_classid\">";
                    echo <<<FORM
                    <div class="fields">
                        <div class="field half">
                            <label for="upd_C_No">课程ID</label>
                            <input type="text" readonly="readonly" name="upd_C_No" id="upd_C_No" placeholder="$upd_C_No"/>
                        </div>
                        <div class="field half">
                            <label for="upd_C_Name">名称</label>
                            <input type="text" name="upd_C_Name" id="upd_C_Name" placeholder="$upd_C_Name"/>
                        </div>
                        <div class="field half">
                            <label for="upd_C_Credit">学分</label>
                            <input type="text" name="upd_C_Credit" id="upd_C_Credit" placeholder="$upd_C_Credit"/>
                        </div>
                        <div class="field half">
                            <label for="upd_C_Type">类型</label>
                            <select name="upd_C_Type" id="upd_C_Type">
FORM;
                    if($upd_C_Type == "必修")
                    {
                        echo "<option value=\"必修\">必修</option>";
                        echo "<option value=\"实践\">实践</option>";
                        echo "<option value=\"选修\">选修</option>";
                    }else if($upd_C_Type == "选修")
                    {
                        echo "<option value=\"选修\">选修</option>";
                        echo "<option value=\"必修\">必修</option>";
                        echo "<option value=\"实践\">实践</option>";
                    }else if($upd_C_Type == "实践")
                    {
                        echo "<option value=\"实践\">实践</option>";
                        echo "<option value=\"选修\">选修</option>";
                        echo "<option value=\"必修\">必修</option>";
                    }else{
                        echo "<option value=\"实践\">未设置 - 默认实践</option>";
                        echo "<option value=\"实践\">实践</option>";
                        echo "<option value=\"选修\">选修</option>";
                        echo "<option value=\"必修\">必修</option>";
                    }
                    echo <<<INPUT
                            </select>
                        </div>
                    </div>
                        <div class="field">
                            <label for="upd_C_Credit">课程备注</label>
                            <textarea name="upd_C_Credit" id="upd_C_Credit" placeholder="$upd_C_Des"></textarea>
                        </div>
                        <br>
                    <ul class="actions">
                        <li><input type="submit" value="提交更改" class="primary" /></li>
                        <li><input type="reset" value="清除" /></li>
INPUT;
                    echo "<li><a href=\"$server_addrr/public/php_service/panel_admin_class.php?delclassid=$choose_classid\" class=\"button primary\">删除课程</a></li>";
                    echo "</ul>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div id=\"update_info\"></div>";

                    if($upd_status == "yes")
                    {
                        echo "<div class=\"alert alert-success\">";
                        echo "更新完成!受影响的信息:<br>";
                        if(!empty($upd_C_Name))
                        {
                            $updsql = new mssql_exec_count
                            (
                                'MSSQL-Student',
                                'sa',
                                '123456',
                                "UPDATE C_Info SET C_Name='$upd_C_Name' WHERE C_No='$choose_classid';"
                            );
                            $updsql->setConnect();
                            $updsql->execData();
                            echo "课程名:$upd_C_Name<br>";
                        }
                        if(!empty($upd_C_Credit))
                        {
                            $updsql = new mssql_exec_count
                            (
                                'MSSQL-Student',
                                'sa',
                                '123456',
                                "UPDATE C_Info SET C_Credit='$upd_C_Credit' WHERE C_No='$choose_classid';"
                            );
                            $updsql->setConnect();
                            $updsql->execData();
                            echo "学分:$upd_C_Credit<br>";
                        }
                        if(!empty($upd_C_Type))
                        {
                            $updsql = new mssql_exec_count
                            (
                                'MSSQL-Student',
                                'sa',
                                '123456',
                                "UPDATE C_Info SET C_Type='$upd_C_Type' WHERE C_No='$choose_classid';"
                            );
                            $updsql->setConnect();
                            $updsql->execData();
                            echo "类型:$upd_C_Type<br>";
                        }
                        if(!empty($upd_C_Des))
                        {
                            $updsql = new mssql_exec_count
                            (
                                'MSSQL-Student',
                                'sa',
                                '123456',
                                "UPDATE C_Info SET C_Des='$upd_C_Des' WHERE C_No='$choose_classid';"
                            );
                            $updsql->setConnect();
                            $updsql->execData();
                            echo "类型:$upd_C_Des<br>";
                        }
                        //检验
                        echo "</div>";
                    }
                    //下面是box的结束
                }
                ?>
                <!--添加区开始-->
                <hr>
                <h2>添加课程</h2>
                <div id="add"></div>
                <form method="post" action="panel_admin_class.php?add_status=yes#add">
                    <div class="fields">
                        <div class="field half">
                            <label for="add_classid">课程ID</label>
                            <input type="text" name="add_classid" id="add_classid" placeholder="非必填"/>
                        </div>
                        <div class="field half">
                            <label for="add_classname">课程名称</label>
                            <input type="text" name="add_classname" id="add_classname" placeholder="非必填"/>
                        </div>
                        <div class="field half">
                            <label for="add_classcredit">学分</label>
                            <input type="text" name="add_classcredit" id="add_classcredit" placeholder="非必填"/>
                        </div>
                        <div class="field half">
                            <label for="add_classtype">类型</label>
                            <select name="add_classtype" id="add_classtype">
                                <option value="必修">必修</option>
                                <option value="选修">选修</option>
                                <option value="实践">实践</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="name">课程描述</label>
                            <textarea name="add_classdes" id="add_classdes" placeholder="非必填"></textarea>
                        </div>
                    </div>
                    <ul class="actions">
                        <li><input type="submit" value="添加" class="primary" /></li>
                        <li><input type="reset" value="清除" /></li>
                    </ul>
                </form>
                <!--中间空出一段距离-->
                <br>
                <h2>向课程添加学生</h2>
                <!--向课程添加学生-->
                <form method="post" action="panel_admin_class.php?add_status=yesyes#add">
                    <div class="fields">
                        <div class="field half">
                            <label for="add_class_stid">学生ID</label>
                            <input type="text" name="add_class_stid" id="add_class_stid" placeholder="必填"/>
                        </div>
                        <div class="field half">
                            <label for="add_class_classid">课程ID</label>
                            <input type="text" name="add_class_classid" id="add_class_classid" placeholder="必填"/>
                        </div>
                        <div class="field half">
                            <label for="add_class_score">成绩</label>
                            <input type="text" name="add_class_score" id="add_class_score" placeholder="非必填"/>
                        </div>
                    </div>
                    <ul class="actions">
                        <li><input type="submit" value="添加" class="primary" /></li>
                        <li><input type="reset" value="清除" /></li>
                    </ul>
                </form>
                <?php
                if($add_status == "yes")
                {
                    $conn = odbc_connect('MSSQL-Student', 'sa', '123456');
                    if (!$conn) {
                        exit("连接失败: " . $conn);
                    }
                    $sql = "SELECT * FROM C_Info WHERE C_No = '$add_classid'";
                    $rs = odbc_exec($conn, $sql);
                    if (!$rs) {
                        exit("SQL 语句错误");
                    }
                    $distinct_name = odbc_result($rs, "C_Name");
                    $distinct_id = odbc_result($rs, "C_No");
                    if($distinct_name != $add_classname && $distinct_id != $add_classid)
                    {
                        $add_classid = (int)($add_classid);
                        $add_classcredit = (int)($add_classcredit);
                        $tsql = new mssql_exec_count
                        (
                            'MSSQL-Student',
                            'sa',
                            '123456',
                            "INSERT INTO C_Info VALUES ($add_classid,'$add_classname','$add_classtype',$add_classcredit,'$add_classdes')"
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
                    课程ID:$add_classid <br>
                    名称:$add_classname <br>
                    类型:$add_classtype<br>
                    学分:$add_classcredit<br>
                    描述:$add_classdes
                </div>
status_success;
                    }else{
                        echo <<<status_alert
                        <div class="alert alert-danger">
                            添加失败!<br>课程ID $add_classid 或 课程名 $add_classname 已存在
                        </div>
status_alert;
                    }
                }else if($add_status == "yesyes") {
                        $add_class_stid = (int)($add_class_stid);
                        $add_class_classid = (int)($add_class_classid);
                        $tsql = new mssql_exec_count
                        (
                            'MSSQL-Student',
                            'sa',
                            '123456',
                            "INSERT INTO S_C_Info VALUES ('$add_class_stid','$add_class_classid','$add_class_score')"
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
                    课程ID:$add_class_classid <br>
                    学号:$add_class_stid <br>
                    成绩:$add_class_score
                </div>
status_success;
                }
                ?>
                <!--添加区结束-->
            </div>
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
