from flask import Flask, render_template, request

app = Flask(__name__)

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/submit_form', methods=['POST'])
def submit_form():
    if request.method == 'POST':
        name = request.form['name']
        message = request.form['message']
        # Process the form data (name and message) here
        # You can perform actions like saving to a database, sending emails, etc.
        return f"Thank you, {name}! Your message is: {message}"

if __name__ == '__main__':
    app.run(debug=True)
