<?php
/*
 示例
 $tsql = new mssql('ODBC接口','sa','123456','SQL语句');
 $tsql->setConnect();
 $tsql->queryData('查询第几列');
 $tsql->execData();执行SQL语句

查
$qsql = new mssql_bycount_
    (
        'MSSQL-User',
        'sa',
        '123456',
        'SELECT * FROM User_Info'
    );
    $qsql->setConnect();
    $rs = $qsql->queryData(这里写要看几列);
    foreach($rs as $r) {
        foreach($r as $c ) {
            echo $c;
            echo "<br>";
        }
        echo PHP_EOL;
    }

增删改
    $tsql = new mssql_bycount_
    (
        'MSSQL-User',
        'sa',
        '123456',
        "INSERT INTO User_loginRec (logintime,timezone,ip,isdeny) VALUES ('22100','2100','2100','2100')"
    );
    $tsql->setConnect();
 */
class mssql_exec_count
{
    private mixed $conn;
    //与mssql连接后返回resource
    private mixed $instance;
    //ODBC实例名
    private mixed $username;
    //mssql用户名
    private mixed $password;
    //密码
    private mixed $sql;
    //执行的SQL语句 支持增删改查

    function __construct( $odbc_instance_name, $mssql_username , $mssql_password , $sql_command )
    {
        $this->instance = $odbc_instance_name;
        $this->username = $mssql_username;
        $this->password = $mssql_password;
        $this->sql = $sql_command;
    }
    function setConnect(): void
    {
        $this->conn = odbc_connect($this->instance, $this->username, $this->password);
        if (!$this->conn)
        {
            exit("Connect ERROR: " . $this->conn);
        }
    }
    function queryData($fieldcount): ?array
    {
        if (is_null($this->conn))
        {
            return null;
        }
        $rs = odbc_exec($this->conn,$this->sql);
        if( $rs === false)
        {
            echo 'Sql ERROR : ' . $this->sql;
            exit;
        }
        $table = [];
        if(odbc_num_rows($rs) == 0)
        {
            return $table;
        }
        while (odbc_fetch_row($rs))
        {
            $row = [];
            $n = 0;
            while( $n < $fieldcount )
            {
                $row[] = odbc_result($rs, ++$n);
            }
            $table[] = $row;
        }
        if( count($table) > 0  )
        {
            odbc_free_result($rs);
        }
        odbc_close($this->conn);
        return $table;
    }
    function execData()
    {
        if (is_null($this->conn))
        {
            return null;
        }
        odbc_exec($this->conn, $this->sql);
        odbc_close($this->conn);
    }
    //弃用closeConnect 已经包含在上面的方法中
    function closeConnect(): void
    {
        odbc_close($this->conn);
    }
    //析构函数 销毁已有function
    function __destruct() {
        //NULL
    }
}