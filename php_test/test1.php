<?php
require_once 'mssql_exec_count.php';

    $qsql = new mssql_exec_count
    (
        'MSSQL-User',
        'sa',
        '123456',
        'SELECT * FROM User_Info'
    );
    $qsql->setConnect();
    $rs = $qsql->queryData(2);
    foreach($rs as $r) {
        foreach($r as $c ) {
            echo $c;
            echo "<br>";
        }
        echo PHP_EOL;
    }
