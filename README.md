# I.PSPTeachingManageSystem介绍
使用PHP + SQL Server + Python开发的教务系统

## II.PHP2Python接口使用说明
### 接口构成
-  PHP2Python.php
-  数据库User -> 表dbo.User_Interface

### 运行步骤
#### PHP阶段
1. 用户在panel_admin.php选择对应功能面板

2. panel_admin.php通过GET方法将`$python_loc`(即对应的要访问的Python WEB地址)数据传递给PHP2Python.php

3. PHP2Python.php被唤起后，从session中读取`$username`和`$auth`，从GET方法传递的`$_GET["python_loc"]`中读取`$python_loc`

4. 创建session_id，由username + 当前时间`(格式:YYYY:MM:DD HH:MM:SS)`的MD5值组成

5. 显示加载中的HTML页面，通过ODBC连接DSN MSSQL-User 从而连接数据库User中的表dbo.User_Interface

6. 向表写入数据 由三部分组成：`$session_id`,`$username`,`$auth`

7. if语句通过`$python_loc`判断要前往的Python WEB地址

8. 使用`die();`结束PHP的工作并刷新页面到对应的Python WEB,使用GET方法传递`$session_id`,`$username`,`$auth`(即`PROTOCOL://URL?session_id=&username=&auth=`)
#### Python阶段
1. 从GET方法中获取`$session_id`,`$username`,`$auth`的值

2. 连接数据库User中的表dbo.User_Interface

3. 将`$session_id`,`$username`,`$auth`与数据库中的值对比。如果相同,则删除数据库中的此条记录

4. 鉴权,利用`$auth`判断权限,符合对应权限则通过

> 附 auth详解:
 1 - 管理员
 2 - 教师
 3 - 学生
