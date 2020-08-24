# Online Admission Application for Schools/ Colleges/ Universities
## Introduction
 This is an online admission application for Schools/ Colleges/ Universities built using ```Laravel Framework 7.15.0```.
 
## Features
1. Student
    - Register
    - Login
    - OTP Verification
    - Course Select
    - Instruction Accept
    - Personal Details, Educational details, Documents Upload & View 
1. Admin
    - Login
    - Dashboard
    - User, Eductaion Board, Caste, Religion, Course, Student CRUD (Create, read, update and delete)
    - Feedback View
## Instructions
   - Import ```online-admission.sql``` to your DB. This is a much faster alternative to ```php artisan migrate``` and it additionally comes preloaded with seed values.
   - Rename .env.backup to .env
   - Get SMS API from [Pingsms.in](https://github.com/sa1if3/Quickstart-guide-on-sending-SMS-using-API)
      #### About OTP 
      - Currently Only works on Indian Numbers
      - To send OTP Queue must be running. [Laravel Queue](https://laravel.com/docs/7.x/queues)
      - To disable OTP Verification simply navigate to your DB and Set default value of  `students.where_am_i = 0`
   - Modify the following variables in ```.env``` file according to your configuration
 ```env
 #For Website Header
 APP_NAME="The College Name"
 APP_NAMEB="Address Line"
 APP_NAMEC="Affilated to XYZ University"
 
 #For Database
 DB_DATABASE=online-admission
 DB_USERNAME=root
 DB_PASSWORD=root
 
 #For  Emails
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=cykzhteeam
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

#For SMS
PNGSMS_API_KEY=PE4LIdpNAbnUyCpJaEavJai3rpm2UTLAh0Ko1ogjsm768omdha932mmakahw12KHG
PNGSMS_SENDER_ID=PNGDMO
  ```
  - Follow the routes in ```web.php``` to find out how the application navigates and works.
  - Admin login is in ```\admin```.
  - Admin credentials are ```username = super@admin.com``` and ```password = secret123```
## License
[GPL-2.0 License](https://github.com/sa1if3/online-admission-application-for-colleges/blob/master/LICENSE)

## Screenshots
![Admin Login](https://github.com/sa1if3/online-admission-application-for-colleges/blob/master/public/student_front/images/screenshot1.JPG)
![Admin Dashboard](https://github.com/sa1if3/online-admission-application-for-colleges/blob/master/public/student_front/images/screenshot2.JPG)
![Web Home](https://github.com/sa1if3/online-admission-application-for-colleges/blob/master/public/student_front/images/screenshot3.JPG)
![Web Home2](https://github.com/sa1if3/online-admission-application-for-colleges/blob/master/public/student_front/images/screenshot4.JPG)
![Student Register](https://github.com/sa1if3/online-admission-application-for-colleges/blob/master/public/student_front/images/screenshot5.JPG)
![Student Login](https://github.com/sa1if3/online-admission-application-for-colleges/blob/master/public/student_front/images/screenshot6.JPG)
![Student Form Submit](https://github.com/sa1if3/online-admission-application-for-colleges/blob/master/public/student_front/images/screenshot7.JPG)
