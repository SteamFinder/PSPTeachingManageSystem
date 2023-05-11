<?php
require('./mssql_exec_name.php');
    echo "<meta charset=\"gb2312\">";
    $tsql = new mssql_exec_name('MSSQL-Student','sa','123456','SELECT St_ID,St_Name FROM St_Info','St_ID','St_Name','','','');
    $tsql->setConnect();
    $result = $tsql->getResult2();
    $i=0;
    while(true)
    {
        echo "final: " . $result[$i][0] . " " . $result[$i][1] ."<br>";
        $i++;
        if(!isset($result[$i][0]))
        {
            break;
        }
    }
    $tsql->closeConnect();