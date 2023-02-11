#Instaling an MQTT Broker

## Install the mosquitto MQTT Broker

mosquitto is a popular MQTT broker that is well-supported on Debian-based Linux platforms such as Raspbian. It’s easy to install using apt:-

```
sudo apt install mosquitto mosquitto-clients
```

You’ll need to enter your password the first time you run sudo.

You don’t strictly need the mosquitto-clients package for running the broker, but installing it allows you to run the MQTT client code locally which is great for testing.

It also means you can use the Raspberry Pi as a proper MQTT client as well as a broker. This means you could, for example, add a user interface to control other MQTT clients around your home directly from the Raspberry Pi.

## Enable the mosquitto broker

Enable the broker and allow it to auto-start after reboot using the following command:-

```
sudo systemctl enable mosquitto
```

The broker should now be running. You can confirm by checking the systemd service status:-

```
sudo systemctl status mosquitto
```

This should produce an output similar to:-

```
● mosquitto.service - Mosquitto MQTT Broker
     Loaded: loaded (/lib/systemd/system/mosquitto.service; enabled; vendor pr>
     Active: active (running) since Sat 2023-02-11 13:57:48 EST; 56s ago
       Docs: man:mosquitto.conf(5)
             man:mosquitto(8)
   Main PID: 3173 (mosquitto)
      Tasks: 1 (limit: 779)
        CPU: 140ms
     CGroup: /system.slice/mosquitto.service
             └─3173 /usr/sbin/mosquitto -c /etc/mosquitto/mosquitto.conf

Feb 11 13:57:48 raspberrypi systemd[1]: Starting Mosquitto MQTT Broker...
Feb 11 13:57:48 raspberrypi systemd[1]: Started Mosquitto MQTT Broker.
```

Now configure Mosquitto to serve remote hosts:

```
sudo nano /etc/mosquitto/conf.d/mosquitto.conf

```
add the following lines
```
allow_anonymous true
listener 1883 0.0.0.0

```
type the following to load the new settings
```
sudo systemctl restart mosquitto
```

## Publish/Subscribe to a Topic Locally and Remotely
TestingMQTT Topic Locally

In this section, we will test if our server is active by using the Raspberry Pi terminals to test. Follow the steps given below to do so.

Test Mosquitto by creating two new instances of the terminal.

In the first new terminal enter the following:
```
mosquitto_sub -v -t test/message
```

In the second new terminal enter:

```
mosquitto_pub -t test/message -m 'Hello World!'
```

After pressing enter in your second new terminal you should see the message “test/message Hello World!” on the first terminal.

## TestingMQTT Topic Remotely

When it comes to a remote connection, we need to set up MQTT clients on a second computer.

### Installing mosquitto MQTT Client on Linux

You can set up a second computer with the MQTT clients as we did above and as follows:

```
sudo apt install mosquitto-clients
```
If your installation doesn’t yet support apt, replace it with apt-get.

### Installing mosquitto MQTT Client on mac OS

Or if you’re on mac OS, there’s no separation between the the broker and client packages, so just use the following to install everything:-

```
brew update
brew install mosquitto
```

### Installing mosquitto MQTT Client on Windows

Ins	tallation and usage on a Windows machine will be different – see [this download link](https://mosquitto.org/download/) for more info.

### Obtaining the Raspberry Pi host name and IP address

Please note that you have to keep the Broker running on your Raspberry Pi for this to work. Additionally, you will need the hostname or IP of your Raspberry Pi. For that, simply type these commands on your Pi terminal:

```
hostname    #to obtain the hostname. default name is raspberrypi
hostname -I  #to obtain the IP address of your Pi
```
For the remainder we will imagine the hostname is MQTT and the IP address is 192.168.1.23

Take note of these values as you will need them.

### Testing clients from Windows

In Windows, open two command prompts.
In the first prompt, type the folowing commands:

```
cd <--location of your mosquitto folder. Default : C:/Program Files/mosquitto-->
```
to move to the appropriate folder and then either of these to subscribe to the `test/message` topic.
```
mosquitto_sub -h MQTT -t "test/message"
```
or
```
mosquitto_sub -h 192.168.1.23 -t "test/message"
```
In the second prompt:
```
cd <--location of your mosquitto folder. Default : C:/Program Files/mosquitto-->
```
To move to the mosquitto client folder.

```
mosquitto_pub -h MQTT -t "test/message" -m "Hello World!"
```
Where raspberrypi is the name of the Raspberry Pi hosting the MQTT Broker. Alternately run
```
mosquitto_pub -h 192.168.1.23 -t "test/message" -m "Hello World!"
```

### Testing clients from Linux

In the first window, subscribe to the test message like this:

```
mosquitto_sub -v -h MQTT -t "test/message"
```
OR
```
mosquitto_sub -v -h 192.168.1.23 -t "test/message"
```

In the second window, type the folowing to publish a message.
```
mosquitto_pub -h MQTT -t "test/message" -m "Hello World!"
```
Where raspberrypi is the name of the Raspberry Pi hosting the MQTT Broker. Alternately run
```
mosquitto_pub -h 192.168.1.23 -t "test/message" -m "Hello World!"
```


