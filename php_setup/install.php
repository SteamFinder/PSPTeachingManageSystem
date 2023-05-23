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
$PHPServerIP = $_POST["PHPServerIP"] ?? NULL;
$PyServerIP = $_POST["PyServerIP"] ?? NULL;
$DBType = "Microsoft SQL Server";//锁定
$DBVer = "2019";//锁定
$DBIP = $_POST["DBIP"] ?? NULL;
$DBPort = $_POST["DBPort"] ?? NULL;
$DBAdmin = $_POST["DBAdmin"] ?? NULL;
$DBPassword = $_POST["DBPassword"] ?? NULL;
    if($PHPServerIP == NULL || $PyServerIP == NULL
        || $DBIP == NULL    || $DBPort == NULL
        ||$DBAdmin == NULL  || $DBPassword == NULL){
        die("<meta http-equiv=\"refresh\" content=\"0;url=/public/setup.php?info=安装信息不足\">");
    }
    $SetupInfo = array(
        'PHPServerIP' => $PHPServerIP,
        'PyServerIP' => $PyServerIP,
        'DBType' => $DBType,
        'DBVer' => $DBVer,
        'DBIP' => $DBIP,
        'DBPort' => $DBPort,
        'DBAdmin' => $DBAdmin,
        'DBPassword' => $DBPassword,
    );
    //写入php_setup
    //w:只写。打开并清空文件的内容；如果文件不存在，则创建新文件。
    $OutConfig = fopen("config.json","w");
    //fwrite 写入json
    fwrite($OutConfig, json_encode($SetupInfo));
    //关闭连接
    fclose($OutConfig);
    //写入根目录
    //w:只写。打开并清空文件的内容；如果文件不存在，则创建新文件。
    $OutConfig = fopen("../config.json","w");
    //fwrite 写入json
    fwrite($OutConfig, json_encode($SetupInfo));
    //关闭连接
    fclose($OutConfig);
    //写入php_service
    //w:只写。打开并清空文件的内容；如果文件不存在，则创建新文件。
    $OutConfig = fopen("../php_service/config.json","w");
    //fwrite 写入json
    fwrite($OutConfig, json_encode($SetupInfo));
    //关闭连接
    fclose($OutConfig);
    die("<meta http-equiv=\"refresh\" content=\"0;url=../setup.php?info=安装成功&status=success\">");