from flask import Flask

app = Flask(__name__)


@app.route("/")
def index():
    with open("student_profile.html", encoding="gb2312") as f:
        content = f.read()
    return content


app.run(debug=True)
