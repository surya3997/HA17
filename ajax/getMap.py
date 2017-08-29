#!/usr/bin/python3

import json
from flask import Flask, request
app = Flask(__name__)

@app.route("/", methods=['POST'])
def hello():
    user =  request.form['username'];
    return json.dumps({'status':'OK','user':"user" + user});

@app.route("/pr", methods=['GET'])
def hello1():
    print(request.data)
    return json.dumps({'status':'OK','user':"user"});


if __name__ == '__main__':
    app.run()