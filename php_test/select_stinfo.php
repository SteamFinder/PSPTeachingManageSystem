<?php
//  启动会话
session_start();
$server_addrr = "http://localhost:".$_SERVER["SERVER_PORT"];
//  判断是否登录并鉴权
if( isset($_SESSION["auth"])) {
    if($_SESSION["auth"] == 1)
    {
        echo "ACCESS PASS<br>";
        echo "Session Auth:" . $_SESSION["auth"] . "<br>";
    }else{
        $auth = $_SESSION["auth"];
        echo "<meta http-equiv=\"refresh\" content=\"0;url=$server_addrr/public/old_login.php?info=wrong&auth=$auth&detail=No Permission\">";
        die();
    }
} else {
    die("ACCESS DENIED<br>");
}
header('Content-type:text/html;charset=gb2312');
$conn=odbc_connect('MSSQL-Student','sa','123456');
if (!$conn)
{
    exit("连接失败: " . $conn);
}
$sql = "SELECT St_ID,St_Name,St_Sex FROM St_Info";
$rs=odbc_exec($conn,$sql);
if (!$rs)
{
    exit("SQL 语句错误");
}
echo <<<EOF
<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/css/bootstrap.min.css">
<script src="https://cdn.staticfile.org/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>
<div class="container-sm ">
<div class="row">
<div class=".col-sm-">
<h1>SQL & PHP TEST</h1>
<form action="select_stinfo.php" method="get">
  <div class="input-group mb-3">
    <span class="input-group-text">Exec</span>
    <input type="text" class="form-control" placeholder="Please Enter Your SQL Command" name="sql">
    <button type="submit" value="Submit" class="btn btn-primary" >Execute</button>
  </div>
 </form>
</div>
EOF;
 echo "<br><br><br><div class=\"alert alert-success\">The Command You Have entered:";
 if(isset($_GET["sql"]))
 {
     echo $sql = $_GET["sql"];
     $rs=odbc_exec($conn,$sql);
 }else{
     echo $sql;
 }
 echo "</div>";
echo <<<EOD
</form>
</div>
<div class="row">
  <table class="table table-striped" >
  <thead>
     <tr>
     <th>St_ID</th>
     <th>St_Name</th>
     <th>St_Sex</th>
     </tr>
  </thead>
  <tbody>
EOD;
while (odbc_fetch_row($rs))
{
    $St_ID = odbc_result($rs,"St_ID");
    $St_Name = odbc_result($rs,"St_Name");
    $St_Sex = odbc_result($rs,"St_Sex");
    echo "<tr>";
    echo "<td>" . $St_ID . "</td><td>" . $St_Name . "</td><td>" . $St_Sex ."</td>";
    echo "</tr>";
}
odbc_close($conn);
echo "</tbody></table></div></div>";
