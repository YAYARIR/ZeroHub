from flask import Flask, request, jsonify
import json

app = Flask(__name__)
USERS_FILE = 'users.json'

def load_users():
    try:
        with open(USERS_FILE, 'r') as f:
            return json.load(f)
    except FileNotFoundError:
        return []

def save_user(username):
    users = load_users()
    if username not in users:
        users.append(username)
        with open(USERS_FILE, 'w') as f:
            json.dump(users, f)

@app.route('/get_suggestions')
def get_suggestions():
    query = request.args.get('query', '').lower()
    users = load_users()
    suggestions = [user for user in users if query in user.lower()]
    return jsonify({'suggestions': suggestions})

@app.route('/check_user')
def check_user():
    username = request.args.get('username', '').strip()
    if username:
        save_user(username) # Сохраняем введенное имя пользователя
        users = load_users()
        return jsonify({'exists': username in users})
    return jsonify({'exists': False})

if __name__ == '__main__':
    app.run(debug=True)
