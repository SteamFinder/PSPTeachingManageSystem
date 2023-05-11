<html>
<body>
<?php
header('Content-type:text/html;charset=utf-8');
$conn=odbc_connect('MSSQLSERVER','sa','123456');
if (!$conn)
{
    exit("连接失败: " . $conn);
}
$sql="SELECT * FROM User_Info";
$rs=odbc_exec($conn,$sql);
if (!$rs)
{
    exit("SQL 语句错误");
}
echo "<table><tr>";
echo "<th>username</th>";
echo "<th>password</th></tr>";
while (odbc_fetch_row($rs))
{
    $username = odbc_result($rs,"username");
    $password = odbc_result($rs,"password");
    echo "<tr><td>$username</td>";
    echo "<td>$password</td></tr>";
}
odbc_close($conn);
echo "</table>";
?>

</body>
</html>