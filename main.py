from flask import Flask, render_template, request, redirect

app = Flask(__name__)

@app.route('/')
def main_page():
    return render_template('index.html')

@app.route('/<string:page_name>')
def html_page(page_name):
    return render_template(page_name)

def write_to_csv(data):
    with open ('database.csv', newline='', mode='a') as database:
        email = data['email']
        csv_writer = csv.writer(database, delimiter=',', quotechar='"', quoting=csv.QUOTE_MINIMAL)
        csv_writer.writerow([email])

@app.route('/submit_form', methods=['POST', 'GET'])
def submit_form():
    if request.method == 'POST':
        data = request.form.to_dict()
        write_to_csv(data)
        return redirect('/thankyou.html')
    else:
        return 'Something went wrong, please try again!'

def record_message(data2):
    with open ('messages.csv', newline='', mode='a') as database2:
        email = data2['email']
        subject = data2['subject']
        message = data2['message']
        csv_writer2 = csv.writer(database2, delimiter=',', quotechar='"', quoting=csv.QUOTE_MINIMAL)
        csv_writer2.writerow([email,subject,message])

@app.route('/submit_message', methods=['POST', 'GET'])
def submit_message():
    if request.method == 'POST':
        data2 = request.form.to_dict()
        record_message(data2)
        return redirect('/thankyou.html')
    else:
        return 'Something went wrong, please try again!'
