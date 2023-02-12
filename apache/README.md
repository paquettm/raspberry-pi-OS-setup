To install PHP on Raspberry Pi OS, you can follow these steps:

Open terminal and update the package index:

```
sudo apt-get update
```

Install PHP and Apache server:

```
sudo apt-get install apache2 php libapache2-mod-php
```

Verify PHP installation by creating a test file:

```
sudo nano /var/www/html/info.php
```

Add the following code to the file:
```
<?php
    phpinfo();
?>
```
Save and close the file.

Access the file in a web browser by visiting http://127.0.0.1/info.php.

This should install and set up PHP on your Raspberry Pi OS.

Had to do more to get php to version 8.2:

```
sudo apt-get install apache2 php libapache2-mod-php
sudo apt update
sudo apt install lsb-release
curl https://packages.sury.org/php/apt.gpg | sudo tee /usr/share/keyrings/suryphp-archive-keyring.gpg >/dev/null
echo "deb [signed-by=/usr/share/keyrings/suryphp-archive-keyring.gpg] https://packages.sury.org/php/ $(lsb_release -cs) main" | sudo tee /etc/apt/sources.list.d/sury-php.list
sudo apt update
sudo apt install php8.2-cli
sudo apt install php
cd /etc/apache2/mods-enabled/
sudo rm php7.4.load 
sudo rm php7.4.conf 
sudo ln -s ../mods-available/php8.2.conf php8.2.conf
sudo ln -s ../mods-available/php8.2.load php8.2.load
sudo apache2ctl -t
sudo systemctl start apache2
```
