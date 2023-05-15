from flask import render_template
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
