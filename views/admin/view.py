from flask import render_template, request, redirect, url_for
from sqlalchemy.orm import sessionmaker

from models.models import engine, St_Info, S_C_Info
from . import admin_blu


@admin_blu.route("/")
def index():
    DBSession = sessionmaker(bind=engine)
    session = DBSession()
    students = session.query(St_Info).all()
    scores = session.query(S_C_Info).all()
    session.close()
    return render_template("student_profile.html", users=students, scores=scores)


@admin_blu.route("/select_student")
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
        return redirect(url_for("admin.index"))


@admin_blu.route("/select_score")
def select_score():
    ret = request.args
    if ret:
        userid_score = request.args.get("score")
        DBSession = sessionmaker(bind=engine)
        session = DBSession()
        result = session.query(S_C_Info).filter(S_C_Info.St_ID == userid_score).all()
        session.close()
        return render_template("student_profile.html", scores=result)
    else:
        return redirect(url_for("admin.index"))