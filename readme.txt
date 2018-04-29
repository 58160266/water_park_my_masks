MySQL
=====
hostname: db
rootuser: root / rootpasswd
user: myuser / mypasswd
database : mydb

Windows
=======
use powershell 
    run start-dev.bat for start all server
    run stop-dev.bat for stop all server
    run fix-error.bat when start-dev.bat error when finish run start-dev.bat again

OSX
===
use terminal
    run start-dev.sh for start all server
    run stop-dev.sh for stop all server and backup last database
    run fix-error.sh when start-dev.bat error  when finish run start-dev.sh again

open http://localhost when check your result
open http://localhost:8888 for phpMyAdmin 
