#Instaling 'MySQL' (MariaDB)
yadmin
Install the RDBMS software with
```
sudo apt install mariadb-server
```
The installation is not secure by default. Run the following command and answer the questions to make it secure:
```
sudo mysql\_secure\_installation
```
Test the installation with 
```
sudo mysql -u root -p
```
you should get a prompt in the database. type `exit` to leave.

Install `phpMyAdmin` to allow you to easily configure the databases.
add the following line to the /etc/apt/sources.list
```
deb http://deb.debian.org/debian bullseye-backports main
```
```
apt-get update 
apt-get install -t bullseye-backports phpmyadmin	*** WORK IN PROGRESS CHANGING OS PI_TOP OS SEEMS HARD TO CONFIGURE
```
follow the prompts.

Type
```
sudo nano /etc/apache2/apache2.conf
```
Add the following at the bottom of the file:
```
Include /etc/phpmyadmin/apache.conf
```
Type
```
sudo service apache2 restart
```

