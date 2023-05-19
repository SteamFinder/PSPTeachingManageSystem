from flask import render_template, request, redirect, url_for
from sqlalchemy.orm import sessionmaker

from models.models import St_Info, S_C_Info, User_Interface, engine1, engine2
from . import admin_blu


@admin_blu.route("/")
# 主页面和鉴权
def index():
    ret = request.values

    if ret:
        session_id = ret["session_id"]
        username = ret["username"]
        auth = ret["auth"]
        DBSession = sessionmaker(bind=engine2)
        session = DBSession()
        feedback = session.query(User_Interface).filter(User_Interface.session_id == session_id,
                                                        User_Interface.username == username,
                                                        User_Interface.auth == auth).all()
        session.close()
        if feedback:
            DBSession = sessionmaker(bind=engine1)
            session = DBSession()
            students = session.query(St_Info).all()
            scores = session.query(S_C_Info).all()
            session.close()
            return render_template("student_profile.html", users=students, scores=scores)
        else:
            return redirect("http://192.168.137.1:8080/public/login.php?info=wrong&detail=登录信息错误&loc=Python鉴权")

    else:
        return render_template("test.html")


@admin_blu.route("/pass_index")
def pass_index():
    DBSession = sessionmaker(bind=engine1)
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
        DBSession = sessionmaker(bind=engine1)
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
        DBSession = sessionmaker(bind=engine1)
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

        DBSession = sessionmaker(bind=engine1)
        session = DBSession()
        student = St_Info(St_ID=add_stu_id, St_Name=add_stu_name, St_Sex=add_stu_sex, Birthdate=add_stu_birth,
                          Cl_Name=add_stu_class, Telephone=add_stu_phone, PSTS=add_stu_zzmm, Address=add_stu_addr,
                          Resume=add_stu_resu, D_ID=add_st_id)
        session.add(student)
        session.commit()
        session.close()
        return redirect(url_for(".pass_index"))
    else:
        pass


@admin_blu.route("/dir_update_student/<username>")
# 跳转到修改页面
def dir_update_stu(username):
    DBSession = sessionmaker(bind=engine1)
    session = DBSession()
    students = session.query(St_Info).filter(St_Info.St_Name == username).all()
    session.close()
    return render_template("update_student.html", users=students)


@admin_blu.route("/upd_student/<username>")
# 修改学生信息
def upd_stu(username):
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

        DBSession = sessionmaker(bind=engine1)
        session = DBSession()
        student = session.query(St_Info).filter(St_Info.St_Name == username).update({"St_ID": add_stu_id,
                                                                                     "St_Name": add_stu_name,
                                                                                     "St_Sex": add_stu_sex,
                                                                                     "Birthdate": add_stu_birth,
                                                                                     "Cl_Name": add_stu_class,
                                                                                     "Telephone": add_stu_phone,
                                                                                     "PSTS": add_stu_zzmm,
                                                                                     "Address": add_stu_addr,
                                                                                     "Resume": add_stu_resu,
                                                                                     "D_ID": add_st_id})
        session.commit()
        session.close()
        return redirect(url_for(".pass_index"))
    else:
        pass


@admin_blu.route("/select_score", methods=["get", "post"])
# 查询学生成绩
def select_score():
    ret = request.args
    if ret:
        st_id_score = request.args.get("st_num")
        c_id_score = request.args.get("c_num")
        DBSession = sessionmaker(bind=engine1)
        session = DBSession()
        result = session.query(S_C_Info).filter(S_C_Info.C_No == c_id_score, S_C_Info.St_ID == st_id_score).all()
        session.close()
        return render_template("student_profile.html", scores=result)
    else:
        pass


@admin_blu.route("/add_score", methods=["get", "post"])
# 添加学生成绩
def add_score():
    ret = request.args
    if ret:
        add_score_id = request.args.get("add_score_id")
        add_score_class = request.args.get("add_score_class")
        add_score_sco = request.args.get("add_score_sco")

        DBSession = sessionmaker(bind=engine1)
        session = DBSession()
        score = S_C_Info(St_ID=add_score_id, C_No=add_score_class, Score=add_score_sco)
        session.add(score)
        session.commit()
        session.close()

        return redirect(url_for(".pass_index"))
    else:
        pass


@admin_blu.route("/delete_score")
# 删除学生成绩
def delete_score():
    ret = request.args
    if ret:
        st_id_score = request.args.get("st_num")
        c_id_score = request.args.get("c_num")
        DBSession = sessionmaker(bind=engine1)
        session = DBSession()
        result = session.query(S_C_Info).filter(S_C_Info.C_No == c_id_score, S_C_Info.St_ID == st_id_score).delete()
        session.commit()
        session.close()
        return render_template("student_profile.html")
    else:
        pass


@admin_blu.route("/dir_update_score/<score_st_id>/<score_c_no>")
# 转到修改学生成绩的界面
def dir_update_score(score_st_id, score_c_no):
    DBSession = sessionmaker(bind=engine1)
    session = DBSession()
    score = session.query(S_C_Info).filter(S_C_Info.St_ID == score_st_id, S_C_Info.C_No == score_c_no).all()
    session.close()

    ip_addr = request.remote_addr
    return render_template("update_score.html", users=score, ip=ip_addr)


@admin_blu.route("/upd_score/<score_st_id>/<score_c_no>")
# 修改学生成绩
def upd_score(score_st_id, score_c_no):
    ret = request.args
    if ret:
        upd_stid = ret.get("upd_stid")
        upd_class = ret.get("upd_class")
        upd_score = ret.get("upd_score")

        DBSession = sessionmaker(bind=engine1)
        session = DBSession()
        sco = session.query(S_C_Info).filter(S_C_Info.St_ID == score_st_id, S_C_Info.C_No == score_c_no).update(
            {"St_ID": upd_stid,
             "C_No": upd_class,
             "Score": upd_score})
        session.commit()
        session.close()
        return redirect(url_for(".pass_index"))
    else:
        pass
