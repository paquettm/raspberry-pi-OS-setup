# PHP installation

Follow these steps at the command line:
Ensure lsb-release is installed:
```
sudo apt update
sudo apt install lsb-release
```
Get the GPG key to allow adding the third party repository:
```
curl https://packages.sury.org/php/apt.gpg | sudo tee /usr/share/keyrings/suryphp-archive-keyring.gpg >/dev/null
echo "deb [signed-by=/usr/share/keyrings/suryphp-archive-keyring.gpg] https://packages.sury.org/php/ $(lsb_release -cs) main" | sudo tee /etc/apt/sources.list.d/sury-php.list
```
Update apt and install php (8.2 at the time of writing these lines):
```
sudo apt update
sudo apt install php8.2-cli
```
Test your PHP install:
```
echo "<?php echo 'Hello World';" > test.php
php -v
php test.php
```
You should see "Hello World" printed at the command line.
You can delete that test.php file as follows: `rm test.php`

Note:
I had to run the following to get php working with apache2:
```
sudo apt install php
```
