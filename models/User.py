import urllib
from urllib.parse import quote

import sqlalchemy
from sqlalchemy import Column, String, Integer, ForeignKey
from sqlalchemy import Date
from sqlalchemy.ext.declarative import declarative_base

server = '192.168.44.128'
database = 'User'
username = 'sa'
password = '123456'

quoted = urllib.parse.quote_plus('DRIVER={ODBC Driver 18 for SQL Server};'
                                 'SERVER=' + server + ';DATABASE=' + database + ';ENCRYPT=no;UID=' + username + ';PWD=' + password)
engine = sqlalchemy.create_engine('mssql+pyodbc:///?odbc_connect={}'.format(quoted))

Base = declarative_base()


class User_Interface(Base):
    __tablename__ = 'User_Interface'

    session_id = Column(String(64), primary_key=True)
    username = Column(String(64))
    auth = Column(String(64))