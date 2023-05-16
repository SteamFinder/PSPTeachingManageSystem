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


@admin_blu.route("/add_student")
# 添加学生信息
def add_stu():
    ret = request.args
    if ret:
        add_stu_id = request.args.get("add_stu_id")
        add_stu_name = request.args.get("add_stu_name")
        add_stu_sex = request.args.get("add_stu_sex")
        add_stu_birth = request.args.get("add_stu_birth")
        add_stu_class = request.args.get("add_stu_class")
        add_stu_phone = request.args.get("add_stu_phone")
        add_stu_zzmm = request.args.get("add_stu_zzmm")
        add_stu_addr = request.args.get("add_stu_zzmm")
        add_stu_resu = request.args.get("add_stu_resu")
        add_st_id = request.args.get("add_st_id")

        DBSession = sessionmaker(bind=engine)
        session = DBSession()
        student = St_Info(St_ID=add_stu_id, St_Name=add_stu_name, St_Sex=add_stu_sex, Birthdate=add_stu_birth,
                       Cl_Name=add_stu_class, Telephone=add_stu_phone, PSTS=add_stu_zzmm, Address=add_stu_addr,
                       Resume=add_stu_resu, D_ID=add_st_id)
        session.add(student)
        session.commit()
        session.close()
        return redirect(url_for(".index"))
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
