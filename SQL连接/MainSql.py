import pyodbc

server = '192.168.44.128'
database = 'student_db'
username = 'sa'
password = '123456'

connect = pyodbc.connect('DRIVER={ODBC Driver 18 for SQL Server};'
                         'SERVER=' + server + ';DATABASE=' + database + ';ENCRYPT=no;UID=' + username + ';PWD=' + password)
if connect:
    print('connect successfully')
else:
    print('connect fail')
print('--------------------------------------------------------')
while 1:
    select = input('请输入相关SQL代码查询：')
    cursor_1 = connect.cursor()
    cursor_1.execute(f"{select}")
    results = cursor_1.fetchall()
    for result in results:
        print(result)
