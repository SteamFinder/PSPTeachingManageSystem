<?php
//  �����Ự
require_once 'panel_auth.php';
panel_admin_auth();
$server_addrr = NULL;
require 'mssql_exec_count.php';
//�����ǽ��ղ�ѯ����post���� ��<form>������
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
//choose_classid ��� �޸� ��ť��ѡ���γ�id
if(isset($_GET["choose_classid"]))
{
    $choose_classid = $_GET["choose_classid"];
}else{
    $choose_classid = NULL;
}
//choose_classname ��id��һ��� ���ݿγ���
if(isset($_GET["choose_classname"]))
{
    $choose_classname = $_GET["choose_classname"];
}else{
    $choose_classname = 2;
}
//choose_class_status ��� �޸� ��ť��ѡ���γ�id + ����״̬��ʶ
if(isset($_GET["choose_class_status"]))
{
    $choose_class_status = $_GET["choose_class_status"];
}else{
    $choose_class_status = NULL;
}
//ɾ���� ɾ��ѡx�ε�xѧ��
if(isset($_GET["del_stid"]))
{
    $del_stid = $_GET["del_stid"];
    $del_stid_status = 1;
}else{
    $del_stid = NULL;
    $del_stid_status = NULL;
}
//��stidһ�� ���߲�����ɾ��ѧ��������
if(isset($_GET["del_stname"]))
{
    $del_stname = $_GET["del_stname"];
}else{
    $del_stname = NULL;
}
//ɾ���Ŀγ�id
if(isset($_GET["delclassid"]))
{
    $delclassid = $_GET["delclassid"];
}else{
    $delclassid = NULL;
}
//�Ƿ������ύ���°�ť yes
if(isset($_GET["upd_status"]))
{
    $upd_status = $_GET["upd_status"];
}else{
    $upd_status = NULL;
}
//���������Ϣ���ύ��ť yes
if(isset($_GET["add_status"]))
{
    $add_status = $_GET["add_status"];
}else{
    $add_status = NULL;
}
//
//
//POST ������Ϣ
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
//���γ����ѧ��
//Ҫ֪�����ĸ�ѧ��
if(isset($_POST["add_class_stid"]))
{
    $add_class_stid = $_POST["add_class_stid"];
}else{
    $add_class_stid = NULL;
}
//Ҫ֪�����ĸ���
if(isset($_POST["add_class_classid"]))
{
    $add_class_classid = $_POST["add_class_classid"];
}else{
    $add_class_classid = NULL;
}
//���ٷ�
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
        <a href="https://www.csu.edu.cn" class="logo"><strong>���ϴ�ѧ</strong> <span>����ϵͳ/����Ա/�γ̹���</span></a>
        <nav class="navbar">
            <a href="#query">�γ̹������ѯ</a>
            <a href="#add">��ӿγ�</a>
            <a href="<?php echo $server_addrr;?>/public/php_service/panel_admin_class.php" class="logo"><strong>ˢ��</strong></a>
        </nav>
    </header>
    <!-- Main -->
        <!--�û�����-->
    <div id="main" class="alt">
        <section id="query">
            <div class="inner">
                <header class="major">
                    <h1>�γ̹���</h1>
                </header>
                <h2>�γ���Ϣ�Ĳ�ѯ�����</h2>
                <section>
                    <form method="post" action="panel_admin_class.php">
                        <div class="fields">
                            <div class="field half">
                                <label for="query_c_id">�γ�ID</label>
                                <input type="text" name="query_c_id" id="query_c_id" placeholder="�Ǳ���"/>
                            </div>
                            <div class="field half">
                                <label for="query_c_name">�γ�����</label>
                                <input type="text" name="query_c_name" id="query_c_name" placeholder="�Ǳ���"/>
                            </div>
                            <div class="field half">
                                <label for="query_c_credit">ѧ��</label>
                                <input type="text" name="query_c_credit" id="query_c_credit" placeholder="�Ǳ���"/>
                            </div>
                            <div class="field half">
                                <label for="name">����</label>
                                <select name="query_c_type" id="query_c_type">
                                    <option value="">- ��ѡ��γ����ͣ��Ǳ�ѡ�� -</option>
                                    <option value="����">����</option>
                                    <option value="ѡ��">ѡ��</option>
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
                            <th>�γ�ID</th>
                            <th>����</th>
                            <th>����</th>
                            <th>ѧ��</th>
                            <th>��ע</th>
                            <th>����</th>
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
                                echo "<a href=\"$server_addrr/public/php_service/panel_admin_class.php?choose_class_status=yes&choose_classid=$temp&choose_classname=$temp_class_name#query_extra\" class=\"button primary\">�޸�</a>";
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
                                echo "<a href=\"$server_addrr/public/php_service/panel_admin_class.php?choose_class_status=yes&choose_classid=$temp&choose_classname=$temp_class_name#query_extra\" class=\"button primary\">�޸�</a>";
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
                    echo "ɾ���γ̳ɹ�";
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
                <!--ѡ�����ʾ-->
                <?php
                //�����ť�� ����choose_class_status =1 ��ʾ������
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
                    echo "��" . $choose_classname . "��ɾ��ѧ��" . $del_stname . "(ID: " . $del_stid . ")" . "�ɹ�!";
                    echo "</div>";
                }
                if($choose_class_status == "yes")
                {
                    echo <<<VIEW
                <div class="box" id="query_extra">
                    <!--��Ϣ��-->
                    <p>�γ�&nbsp;
                        <strong><u>$choose_classname</u></strong>
                        ��ѧ����Ϣ</p>
                    <div class="box">
                <div id="OverflowText">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ѧ��</th>
                            <th>����</th>
                            <th>�Ա�</th>
                            <th>�༶</th>
                            <th>�ɼ�</th>
                            <th>����</th>
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
                            echo "<a href=\"$server_addrr/public/php_service/panel_admin_class.php?choose_class_status=yes&del_stid=$temp&del_stname=$temp2&choose_classid=$choose_classid&choose_classname=$choose_classname#query_extra\" class=\"button primary\">ɾ��</a>";
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
                     <!--������-->
                    <p>�Կγ�&nbsp;
                        <strong><u>$choose_classname</u></strong>
                        ���в���</p>
                    <div class="box">
VIEW;
                    $upd_conn = odbc_connect('MSSQL-Student', 'sa', '123456');
                    if (!$upd_conn) {
                        exit("����ʧ��: " . $upd_conn);
                    }
                    $sql = "SELECT * FROM C_Info WHERE C_No = '$choose_classid'";
                    $rs = odbc_exec($upd_conn, $sql);
                    if (!$rs) {
                        exit("SQL ������");
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
                            <label for="upd_C_No">�γ�ID</label>
                            <input type="text" readonly="readonly" name="upd_C_No" id="upd_C_No" placeholder="$upd_C_No"/>
                        </div>
                        <div class="field half">
                            <label for="upd_C_Name">����</label>
                            <input type="text" name="upd_C_Name" id="upd_C_Name" placeholder="$upd_C_Name"/>
                        </div>
                        <div class="field half">
                            <label for="upd_C_Credit">ѧ��</label>
                            <input type="text" name="upd_C_Credit" id="upd_C_Credit" placeholder="$upd_C_Credit"/>
                        </div>
                        <div class="field half">
                            <label for="upd_C_Type">����</label>
                            <select name="upd_C_Type" id="upd_C_Type">
FORM;
                    if($upd_C_Type == "����")
                    {
                        echo "<option value=\"����\">����</option>";
                        echo "<option value=\"ʵ��\">ʵ��</option>";
                        echo "<option value=\"ѡ��\">ѡ��</option>";
                    }else if($upd_C_Type == "ѡ��")
                    {
                        echo "<option value=\"ѡ��\">ѡ��</option>";
                        echo "<option value=\"����\">����</option>";
                        echo "<option value=\"ʵ��\">ʵ��</option>";
                    }else if($upd_C_Type == "ʵ��")
                    {
                        echo "<option value=\"ʵ��\">ʵ��</option>";
                        echo "<option value=\"ѡ��\">ѡ��</option>";
                        echo "<option value=\"����\">����</option>";
                    }else{
                        echo "<option value=\"ʵ��\">δ���� - Ĭ��ʵ��</option>";
                        echo "<option value=\"ʵ��\">ʵ��</option>";
                        echo "<option value=\"ѡ��\">ѡ��</option>";
                        echo "<option value=\"����\">����</option>";
                    }
                    echo <<<INPUT
                            </select>
                        </div>
                    </div>
                        <div class="field">
                            <label for="upd_C_Credit">�γ̱�ע</label>
                            <textarea name="upd_C_Credit" id="upd_C_Credit" placeholder="$upd_C_Des"></textarea>
                        </div>
                        <br>
                    <ul class="actions">
                        <li><input type="submit" value="�ύ����" class="primary" /></li>
                        <li><input type="reset" value="���" /></li>
INPUT;
                    echo "<li><a href=\"$server_addrr/public/php_service/panel_admin_class.php?delclassid=$choose_classid\" class=\"button primary\">ɾ���γ�</a></li>";
                    echo "</ul>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div id=\"update_info\"></div>";

                    if($upd_status == "yes")
                    {
                        echo "<div class=\"alert alert-success\">";
                        echo "�������!��Ӱ�����Ϣ:<br>";
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
                            echo "�γ���:$upd_C_Name<br>";
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
                            echo "ѧ��:$upd_C_Credit<br>";
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
                            echo "����:$upd_C_Type<br>";
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
                            echo "����:$upd_C_Des<br>";
                        }
                        //����
                        echo "</div>";
                    }
                    //������box�Ľ���
                }
                ?>
                <!--�������ʼ-->
                <hr>
                <h2>��ӿγ�</h2>
                <div id="add"></div>
                <form method="post" action="panel_admin_class.php?add_status=yes#add">
                    <div class="fields">
                        <div class="field half">
                            <label for="add_classid">�γ�ID</label>
                            <input type="text" name="add_classid" id="add_classid" placeholder="�Ǳ���"/>
                        </div>
                        <div class="field half">
                            <label for="add_classname">�γ�����</label>
                            <input type="text" name="add_classname" id="add_classname" placeholder="�Ǳ���"/>
                        </div>
                        <div class="field half">
                            <label for="add_classcredit">ѧ��</label>
                            <input type="text" name="add_classcredit" id="add_classcredit" placeholder="�Ǳ���"/>
                        </div>
                        <div class="field half">
                            <label for="add_classtype">����</label>
                            <select name="add_classtype" id="add_classtype">
                                <option value="����">����</option>
                                <option value="ѡ��">ѡ��</option>
                                <option value="ʵ��">ʵ��</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="name">�γ�����</label>
                            <textarea name="add_classdes" id="add_classdes" placeholder="�Ǳ���"></textarea>
                        </div>
                    </div>
                    <ul class="actions">
                        <li><input type="submit" value="���" class="primary" /></li>
                        <li><input type="reset" value="���" /></li>
                    </ul>
                </form>
                <!--�м�ճ�һ�ξ���-->
                <br>
                <h2>��γ����ѧ��</h2>
                <!--��γ����ѧ��-->
                <form method="post" action="panel_admin_class.php?add_status=yesyes#add">
                    <div class="fields">
                        <div class="field half">
                            <label for="add_class_stid">ѧ��ID</label>
                            <input type="text" name="add_class_stid" id="add_class_stid" placeholder="����"/>
                        </div>
                        <div class="field half">
                            <label for="add_class_classid">�γ�ID</label>
                            <input type="text" name="add_class_classid" id="add_class_classid" placeholder="����"/>
                        </div>
                        <div class="field half">
                            <label for="add_class_score">�ɼ�</label>
                            <input type="text" name="add_class_score" id="add_class_score" placeholder="�Ǳ���"/>
                        </div>
                    </div>
                    <ul class="actions">
                        <li><input type="submit" value="���" class="primary" /></li>
                        <li><input type="reset" value="���" /></li>
                    </ul>
                </form>
                <?php
                if($add_status == "yes")
                {
                    $conn = odbc_connect('MSSQL-Student', 'sa', '123456');
                    if (!$conn) {
                        exit("����ʧ��: " . $conn);
                    }
                    $sql = "SELECT * FROM C_Info WHERE C_No = '$add_classid'";
                    $rs = odbc_exec($conn, $sql);
                    if (!$rs) {
                        exit("SQL ������");
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
                    ��ӳɹ�!<br>
                    �γ�ID:$add_classid <br>
                    ����:$add_classname <br>
                    ����:$add_classtype<br>
                    ѧ��:$add_classcredit<br>
                    ����:$add_classdes
                </div>
status_success;
                    }else{
                        echo <<<status_alert
                        <div class="alert alert-danger">
                            ���ʧ��!<br>�γ�ID $add_classid �� �γ��� $add_classname �Ѵ���
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
                    ��ӳɹ�!<br>
                    �γ�ID:$add_class_classid <br>
                    ѧ��:$add_class_stid <br>
                    �ɼ�:$add_class_score
                </div>
status_success;
                }
                ?>
                <!--���������-->
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
