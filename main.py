from flask import Flask

from views.admin import admin_blu

app = Flask(__name__)

app.register_blueprint(admin_blu)

if __name__ == "__main__":
    app.run(debug=True)
