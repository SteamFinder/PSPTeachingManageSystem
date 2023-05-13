<?php
header('Content-type:text/html;charset=gb2312');
isset($_POST['new_username'])?$new_username = $_POST['new_username']:$new_username = NULL;
isset($_POST['new_password'])?$new_password = $_POST['new_password']:$new_password = NULL;
isset($_POST['st_name'])?$st_name = $_POST['st_name']:$st_name = NULL;
isset($_POST['st_sex'])?$st_sex = $_POST['st_sex']:$st_sex = NULL;
isset($_POST['st_id'])?$st_id = $_POST['st_id']:$st_id = NULL;
isset($_POST['cl_name'])?$cl_name = $_POST['cl_name']:$cl_name = NULL;
$server_addrr = "0.0.0.0:".$_SERVER["SERVER_PORT"];
require 'mssql_exec_count.php';
$conn = odbc_connect('MSSQL-Student', 'sa', '123456');
if (!$conn) {
    exit("连接失败: " . $conn);
}
$sql = "SELECT St_Name FROM St_Info WHERE St_ID = '$st_id' AND St_Sex = '$st_sex' AND Cl_Name = '$cl_name'";
$rs = odbc_exec($conn, $sql);
if (!$rs) {
    exit("SQL 语句错误");
}
if($st_name == odbc_result($rs, "St_Name"))
{
    $conn = odbc_connect('MSSQL-User', 'sa', '123456');
    if (!$conn) {
        exit("连接失败: " . $conn);
    }
    $sql = "SELECT * FROM User_Info WHERE username = '$new_username'";
    $rs = odbc_exec($conn, $sql);
    if (!$rs) {
        exit("SQL 语句错误");
    }
    if(!empty(odbc_result($rs, "username")))
    {
        die("<meta http-equiv=\"refresh\" content=\"0;url=$server_addrr/public/activate.php?info=wrong&detail=用户名已存在&loc=activate_query\">");
    }
    $pwd = md5($new_password);
    $tsql = new mssql_exec_count
    (
        'MSSQL-User',
        'sa',
        '123456',
        "INSERT INTO User_Info VALUES ('$new_username','$pwd','3','$st_id')"
    );
    $tsql->setConnect();
    $tsql->execData();
    die("<meta http-equiv=\"refresh\" content=\"0;url=$server_addrr/public/activate.php?info=success&detail=账号激活成功&loc=activate_query\">");
}else{
    die("<meta http-equiv=\"refresh\" content=\"0;url=$server_addrr/public/activate.php?info=wrong&detail=学生信息输入错误&loc=activate_query\">");
}
