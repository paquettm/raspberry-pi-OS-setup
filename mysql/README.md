#Instaling 'MySQL' (MariaDB)

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
```
sudo apt install phpmyadmin
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

