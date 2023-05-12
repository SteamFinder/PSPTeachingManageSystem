import pyodbc

server = '192.168.44.128'
database = 'User'
username = 'sa'
password = '123456'

connect = pyodbc.connect('DRIVER={ODBC Driver 18 for SQL Server};'
                         'SERVER=' + server + ';DATABASE=' + database + ';ENCRYPT=no;UID=' + username + ';PWD=' + password)

data_tuple = # 数据类型为元组 todo 获取id
session_id, username, auth = data_tuple # 拆包元组

cursor = connect.cursor()
cursor.execute('select session_id from User_Interface where username = result and auth = result')
data = cursor.fetchall() # 查询 id

for item in data:
    if item == tuple():
        print('无权限访问')
    else:
        print('访问成功')

cursor = connect.cursor()
cursor.execute('delete from User_Interface where session_id = session_id ') # 删除临时数据






