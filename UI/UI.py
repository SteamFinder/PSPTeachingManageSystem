import sys

from PyQt5.QtGui import QIcon
from PyQt5.QtWidgets import QWidget, QApplication, QVBoxLayout, QGroupBox, QLineEdit, QPushButton


class MyWindow(QWidget):
    def __init__(self):
        super().__init__()
        self.init_layout()

    def init_layout(self):
        container = QVBoxLayout()  # 创建一个布局器

        information_box = QGroupBox()  # 学生信息组
        information_layout = QVBoxLayout()
        username = QLineEdit(self)
        username.setPlaceholderText('账号:')
        username.setGeometry(55, 20, 200, 20)

        password = QLineEdit(self)
        password.setPlaceholderText('密码:')
        password.setGeometry(55, 20, 200, 20)
        # ------------------------------------------------
        information_layout.addWidget(username)
        information_layout.addWidget(password)
        information_box.setLayout(information_layout)
        # 封装第一个组布局器

        stretch = container.addStretch()

        signin_box = QGroupBox()
        signin_layout = QVBoxLayout()
        button = QPushButton('登录')
        button.setGeometry(100, 100, 100, 50)
        # ------------------------------------------------
        signin_layout.addWidget(button)
        signin_box.setLayout(signin_layout)
        # 封装第二个布局器

        container.addWidget(information_box)
        container.addWidget(stretch)
        container.addWidget(signin_box)
        self.setLayout(container)


if __name__ == '__main__':
    app = QApplication(sys.argv)

    w = MyWindow()
    w.resize(400, 400)
    w.setWindowTitle('中南大学教务平台')
    w.setWindowIcon(QIcon('csu.png'))
    w.show()

    app.exec()
