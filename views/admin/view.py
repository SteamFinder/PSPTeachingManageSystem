from flask import render_template, request, redirect, url_for
from sqlalchemy.orm import sessionmaker

from models.models import engine, St_Info, S_C_Info
from . import admin_blu


@admin_blu.route("/")
# 主页面
def index():
    DBSession = sessionmaker(bind=engine)
    session = DBSession()
    students = session.query(St_Info).all()
    scores = session.query(S_C_Info).all()
    session.close()
    return render_template("student_profile.html", users=students, scores=scores)


@admin_blu.route("/select_student", methods=["get", "post"])
# 查询学生信息
def select_student():
    ret = request.args
    if ret:
        user_name = request.args.get("username")
        DBSession = sessionmaker(bind=engine)
        session = DBSession()
        result = session.query(St_Info).filter(St_Info.St_Name == user_name).all()
        session.close()
        return render_template("student_profile.html", users=result)
    else:
        pass


@admin_blu.route("/delete_student")
# 删除学生信息数据
def delete_student():
    ret = request.args
    if ret:
        user_name = request.args.get("username")
        DBSession = sessionmaker(bind=engine)
        session = DBSession()
        session.query(St_Info).filter(St_Info.St_Name == user_name).delete()
        session.commit()
        session.close()
        return render_template("student_profile.html")
    else:
        pass


@admin_blu.route("/select_score", methods=["get", "post"])
# 查询学生成绩
def select_score():
    ret = request.args
    if ret:
        userid_score = request.args.get("c_num")
        DBSession = sessionmaker(bind=engine)
        session = DBSession()
        result = session.query(S_C_Info).filter(S_C_Info.C_No == userid_score).all()
        session.close()
        return render_template("student_profile.html", scores=result)
    else:
        pass




