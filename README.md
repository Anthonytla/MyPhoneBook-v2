# MyPhoneBook-v2

<pre>
Pull the docker image with the command "docker pull anthonytla/myphonebook".
Run and execute the image and redirect the port 8080 to the port 8090
Execute "composer upgrade"
Change the DBPassword in .env into "your password"
Execute service mysql start
Execute mysql
Create the database Laravel
Enter the command ALTER USER 'root'@'localhost' IDENTIFIED BY 'your password'
Exit mariadb and run "php artisan make:migration"
Run "php artisan migrate"
</pre>

