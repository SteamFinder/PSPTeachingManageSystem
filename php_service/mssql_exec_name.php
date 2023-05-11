<?php
/*
 $tsql = new mssql('ODBC接口','sa','123456','SQL语句','get1 - 列名1'...5);
 $tsql->setConnect();
 $tsql->getResult2();
    ...
    5
 $tsql->insert();
 $tsql->closeConnect();
 */
class mssql_exec_name
{
    private mixed $conn;
    private mixed $instance;
    private mixed $username;
    private mixed $password;
    private mixed $sql;
    private mixed $rs;
    private mixed $get1;
    private mixed $get2;
    private mixed $get3;
    private mixed $get4;
    private mixed $get5;
    private mixed $line1;
    private mixed $line2;
    private mixed $line3;
    private mixed $line4;
    private mixed $line5;

    function __construct( $odbc_instance_name, $mssql_username , $mssql_password , $sql_command , $result_row_name1 , $result_row_name2 , $result_row_name3, $result_row_name4, $result_row_name5 ) {
        $this->instance = $odbc_instance_name;
        $this->username = $mssql_username;
        $this->password = $mssql_password;
        $this->sql = $sql_command;
        $this->get1 = $result_row_name1;
        $this->get2 = $result_row_name2;
        $this->get3 = $result_row_name3;
        $this->get4 = $result_row_name4;
        $this->get5 = $result_row_name5;
    }

    function setConnect(): void
    {
        $this->conn = odbc_connect($this->instance, $this->username, $this->password);
        if (!$this->conn)
        {
            exit("Connect ERROR: " . $this->conn);
        }
    }

    function execData(): void
    {
        odbc_exec($this->conn,$this->sql);
    }
    function getResult2(): array
    {
        $result_array = array();
        $this->rs = odbc_exec($this->conn, $this->sql);
        $i=0;
        while (odbc_fetch_row($this->rs)) {
            $this->line1 = odbc_result($this->rs, $this->get1);
            $this->line2 = odbc_result($this->rs, $this->get2);
            $result_array[$i][0] = $this->line1;
            $result_array[$i][1] = $this->line2;
            $i++;
//            echo $this->get1 . " " . $this->get2;
//            echo "<br>";
//            echo $this->line1 . " " . $this->line2;
//            echo "<br>";
//            echo odbc_fetch_row($this->rs)-1;
//            echo "<br>";
        }
        return $result_array;
    }
    function getResult3(array $result): array
    {
        $this->rs=odbc_exec($this->conn,$this->sql);
        while (odbc_fetch_row($this->rs))
        {
            $this->line1 = odbc_result($this->rs,$this->get1);
            $this->line2 = odbc_result($this->rs,$this->get2);
            $this->line3 = odbc_result($this->rs,$this->get3);
        }
        return $result($this->line1,$this->line2,$this->line3);
    }
    function getResult5(array $result): array
    {
        $this->rs=odbc_exec($this->conn,$this->sql);
        while (odbc_fetch_row($this->rs))
        {
            $this->line1 = odbc_result($this->rs,$this->get1);
            $this->line2 = odbc_result($this->rs,$this->get2);
            $this->line3 = odbc_result($this->rs,$this->get3);
            $this->line4 = odbc_result($this->rs,$this->get4);
            $this->line5 = odbc_result($this->rs,$this->get5);
        }
        return $result($this->line1,$this->line2,$this->line3,$this->line4,$this->line5);
    }
    function closeConnect(): void
    {
        odbc_close($this->conn);
    }
    //析构函数 销毁已有连接
    function __destruct() {
        //NULL
    }
}
//$conn=odbc_connect('MSSQLSERVER','sa','123456');
//if (!$conn)
//{
//exit("连接失败: " . $conn);
//}
//$sql="SELECT * FROM User_Info";
//$rs=odbc_exec($conn,$sql);
//if (!$rs)
//{
//    exit("SQL 语句错误");
//}
//echo "<table><tr>";
//echo "<th>username</th>";
//echo "<th>password</th></tr>";
//while (odbc_fetch_row($rs))
//{
//    $username = odbc_result($rs,"username");
//    $password = odbc_result($rs,"password");
//    echo "<tr><td>$username</td>";
//    echo "<td>$password</td></tr>";
//}
//odbc_close($conn);<?php