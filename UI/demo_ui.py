import sys

import pyodbc
from PyQt5 import uic
from PyQt5.QtWidgets import QWidget, QApplication, QLabel


class My_window(QWidget):
    def __init__(self):
        super().__init__()
        self.init_ui()

    def init_ui(self):
        self.ui = uic.loadUi("./My_ui.ui")
        self.user_name = self.ui.lineEdit
        but = self.ui.pushButton
        self.win = self.ui.widget
        self.label = self.ui.label
        but.clicked.connect(self.but_select)

    def but_select(self):
        # 连接数据库 SQL sever
        server = '192.168.44.128'
        database = 'student_db'
        username = 'sa'
        password = '123456'
        con = pyodbc.connect('DRIVER={ODBC Driver 18 for SQL Server};'
                                 'SERVER=' + server + ';DATABASE=' + database + ';ENCRYPT=no;UID=' + username + ';PWD=' + password)

        select = f"select * from St_Info where St_Name = '{self.user_name.text()}'"

        cursor = con.cursor()
        cursor.execute(f"{select}")
        self.result = cursor.fetchall()

        # 判断查询对象是否存在
        if not self.result:
            print('查无此人!')
        else:
            print(self.result)


if __name__ == '__main__':
    app = QApplication(sys.argv)

    w = My_window()
    w.ui.show()

    app.exec()


