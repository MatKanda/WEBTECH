<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>
<body>
    <div class="container mt5">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Dominik Fullajtár</th>
                    <th>Martin Kršek</th>
                    <th>Martin Kováčik</th>
                    <th>Matúš Kanda</th>
                    <th>Daniel Jankech</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Login / Signup</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>X</td>
                    <td></td>
                </tr>
                <tr>
                    <th>Question type multiple answers</th>
                    <td></td>
                    <td></td>
                    <td>X</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>Question type short text</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>X</td>
                    <td></td>
                </tr>
                <tr>
                    <th>Question type pairs</th>
                    <td></td>
                    <td></td>
                    <td>X</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>Question type drawing</th>
                    <td>X</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>Question type math</th>
                    <td>X</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>End exam</th>
                    <td></td>
                    <td>X</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>Define multiple exams, activ/deactiv</th>
                    <td></td>
                    <td>X</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>Info about exam for teacher</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>X</td>
                </tr>
                <tr>
                    <th>PDF export</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>X</td>
                    <td></td>
                </tr>
                <tr>
                    <th>CSV export</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>X</td>
                </tr>
                <tr>
                    <th>Docker</th>
                    <td></td>
                    <td>X</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>Graphic design, layout</th>
                    <td>X</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>Database</th>
                    <td></td>
                    <td>X</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="w-50 mx-auto">
        <h4>Creating exam</h4>
        <p>Teacher can create a new exam with a "+" sign after signup (on page "Exam overview"), where he inserts the exam name and time limit.
        After clicking "Create" button, the teacher can choose from 5 different question types to add to the exam. 
        Question of the same type can be added multiple times, and not all types of questions are needed to create a exam.
        After submitting the exam, the teacher will be redirected back to page "Exam overview", where he will see the newly added exam.
        The exam is created with status "inactive". Exams are ordered in ascending way: last inserted exam is at the bottom.
        </p>
    
        <h4>Adding questions</h4>
        <p>Each type of question has an add button. Teacher must fill all the inputs, otherwise on submit a modal window will notify the teacher to fill all the values.
           Teacher can delete added question(s) only before submitting them. All questions are submitted "at once": one submit button for all of them.
        </p>

        <h4>Activation / deactivation of exam</h4>
        <p>Each exam has an activation button, which lets the teacher to active the exam. From that moment on, the exam code is valid
        and students can log in using that exam code. Teacher can also deactivate an active exam.
        </p>

        <h4>End exam</h4>
        <p>Exam can be finished in one of two ways. One way of finishing exam is to click submit button. This action is irreversible and for each student on particular exam can be done only once. Second option of finishing exam is to let clock of the timer, set by teacher, run out. After this time all students even partially answered questions will be submited. In both submit options student will be kicked out of test and redirected on login page.
        </p>

        <h4>Define multiple exams, activ/deactiv</h4>
        <p>Teacher has possibility of defining multiple exams. Each exam has its own timer and unique code. With this code can students log into this exam. After exam creation exam is deactivated. So students can not log in to work on this exam. Teacher has to click on button on examOverview website next to that particular exam and activate it by accepting modal window.
        </p>
        
        <h4>Docker</h4>
        <p>We also provide this project in docker containerized format. The application has two containers. One for web application, second one is for database. for the database part we need dump to create correct database on startup. This dump file is in mysql-dump folder. We initialize our database with user. This user is used by our web application to connect. Username is user and password is password. This user is initialized in .docker-compose.yml file. Configuration file about this connection is in .php/config.php. Our web application does use pecee/simple-router. To enable this functionality on linux was needed configuration. To be exact it was to allow override on /var/www/ directory. For simplicity we copied whole apache2.conf into docker vm. This configuration file can be found inside of .conf/ folder. This application starts with docker-compose up --build. If You would like to see database from Your host computer, we recommend using mysql workbench. But it is also possible to connect with commandline command "mysql -h 127.0.0.1 -P 3306 -u user -p" and enter password.
        </p>

        <h4>Exam notifications</h4>
        <p>
        </p>

        <h4>Grading exam</h4>
        <p>
        </p>

        <h4>Exports to pdf / csv</h4>
        <p>
        </p>

        <h4>Database</h4>
        <p>Database design was choosen to have more than needed tables. This option was chosen to support all neccessery functionality and be easily understandable. All question tables are different questions made inside of exam by teacher. Answers are answers provided by student. Student_Exam is table of progress of student in particular exam. Student is table that saves already signed students. This is to prevent student from enrolling to exam with same aisid but different name or surname. Also to not enable student with provided aisid to enroll second time to already finished exam.
        </p>
    </div>
    
</body>
</html>