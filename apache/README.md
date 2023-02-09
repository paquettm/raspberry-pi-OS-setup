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
