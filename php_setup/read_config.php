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
class read_config
{
    private mixed $PHPServerIP;
    private mixed $PyServerIP;
    private mixed $DBIP;
    private mixed $DBPort;
    private mixed $DBAdmin;
    private mixed $DBPassword;

    function readConfig(): void
    {
        $config = json_decode(file_get_contents('config.json'), true);
        $this->PHPServerIP = $config['PHPServerIP'];
        $this->PyServerIP = $config['PyServerIP'];
        $this->DBIP = $config['DBIP'];
        $this->DBPort = $config['DBPort'];
        $this->DBAdmin = $config['DBAdmin'];
        $this->DBPassword = $config['DBPassword'];
    }
    function getPHPServerIP()
    {
        return $this->PHPServerIP;
    }
    function getPyServerIP()
    {
        return $this->PyServerIP;
    }
    function getDBIP()
    {
        return $this->DBIP;
    }
    function getDBPort()
    {
        return $this->DBPort;
    }
    function getDBAdmin()
    {
        return $this->DBAdmin;
    }
    function getDBPassword()
    {
        return $this->DBPassword;
    }
}