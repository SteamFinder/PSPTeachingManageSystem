import urllib
from urllib.parse import quote

import sqlalchemy
from sqlalchemy import Column, String, Integer, ForeignKey
from sqlalchemy import Date
from sqlalchemy.ext.declarative import declarative_base

server = '192.168.44.128'
database = 'Student'
username = 'sa'
password = '123456'

quoted = urllib.parse.quote_plus('DRIVER={ODBC Driver 18 for SQL Server};'
                                 'SERVER=' + server + ';DATABASE=' + database + ';ENCRYPT=no;UID=' + username + ';PWD=' + password)
engine = sqlalchemy.create_engine('mssql+pyodbc:///?odbc_connect={}'.format(quoted))

Base = declarative_base()


class St_Info(Base):
    __tablename__ = 'St_Info'

    St_ID = Column(Integer, nullable=False, primary_key=True, autoincrement=False)
    St_Name = Column(String(20))
    St_Sex = Column(String(2))
    Birthdate = Column(Date)
    Cl_Name = Column(String(15))
    Telephone = Column(String(20))
    PSTS = Column(String(4))
    Address = Column(String(150))
    Resume = Column(String(255))
    D_ID = Column(String(2))


class S_C_Info(Base):
    __tablename__ = 'S_C_Info'

    St_ID = Column(Integer, ForeignKey('St_Info.St_ID'), nullable=False)
    C_No = Column(String(10), nullable=False, primary_key=True, autoincrement=False)
    Score = Column(Integer)


