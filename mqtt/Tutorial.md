# Installing the Mosquitto MQTT Server to the Raspberry Pi

MQTT stands for Message Queuing Telemetry Transport and is a network messaging protocol commonly used for messaging between IoT devices. The MQTT protocol provides a lightweight method of carrying out messaging using a publish/subscribe model. This makes it suitable for Internet of Things messaging such as with low power sensors or mobile devices such as phones, embedded computers or microcontrollers.

To get our Raspberry Pi to support the MQTT protocol, we will be using a server software called (Eclipse) Mosquitto (https://mosquitto.org/).

Eclipse Mosquitto is an open source (EPL/EDL licensed) message broker that implements the MQTT protocol versions 5.0, 3.1.1 and 3.1.
Mosquitto is lightweight and is suitable for use on all devices from low power single board computers to full servers.

The MQTT protocol works by having clients act as publishers and subscribers. The publishers send the messages through to a broker that serves as the middle man.
Subscribers connect to the MQTT broker and read messages that are being broadcast under a specific topic.
You can use MQTT for having multiple sensors to send their data to your Raspberry Pi’s MQTT broker, which client devices can then receive that data.
If you want to learn more about the MQTT protocol and why it is excellent for IoT devices such as the Raspberry Pi, be sure to check out the official MQTT website.


## Equipment
Below you can view the list of equipment we used when installing the MQTT broker to our Raspberry Pi. This procedure was tested with Raspberry Pi OS lite 32bit on Pi Zero W and Raspberry Pi Os 64 bit on Raspberry Pi 4.

### Mandatory
* Raspberry Pi any version should work, with Raspberry Pi OS installed and functional 
* Micro SD Card (8GB+)
* Internet access through WiFi (or Ethernet if available)
### Optional
* Raspberry Pi Case
* USB Keyboard
* USB Mouse

## Before you start
If your raspberry pi is connected to a screen and keyboard, you may proceed with entering all the commands in a terminal window.
However, if you are planning on running the Raspberry Pi in headless mode, ensure that you have proper access to the unit over SSH or VNC.

## Installing Mosquitto to the Raspberry Pi

In this section, we will show you how to install the Mosquitto broker to your Raspberry Pi.

Before proceeding, it may be worth setting your Raspberry Pi up with a static IP address or with a .local hostname to provide you with a known connection address.

Connect to your Raspberry Pi over SSH or start a terminal window and follow the instructions below
1. Before installing the MQTT broker to our Raspberry Pi, we usually update the operating system.
All we need to do to update the system is to run the following two commands.
```
sudo apt update
sudo apt upgrade
```

2. Once the system has finished updating, we can now install the Mosquitto software.
The Mosquitto MQTT broker is available as part of the Raspbian repository, so installing the software only requires command-line instructions.
Run the following command to install Mosquitto alongside its client software.
```
sudo apt install mosquitto mosquitto-clients
```
The mosquitto-clients package will allow us to interact with and test that our MQTT broker is running correctly on our Raspberry Pi.
During the installation process, the package manager will automatically configure the Mosquitto server to start on boot.
However, the broker will not be able to accept external connections! We will proceed with extra configuration for this.

3. At this point, you will now have the Mosquitto MQTT broker up and running on your device.
You can verify that it is installed and running by using the command below.
```
sudo systemctl status mosquitto
```
This command will return the status of the “mosquitto” service.
You should see the text “active (running)” if the service has started up properly.

## Testing the Mosquitto Installation on the Raspberry Pi
Our next step will be to test that the service works as it should be and is now acting as an MQTT broker locally on our Raspberry Pi.
To do this, we will be making use of the Mosquitto client.
For this section, you will need to open up two terminal sessions to your Raspberry Pi (Either locally or over SSH).

1. Our first task is to start up a subscriber. The subscriber is what will listen to our MQTT broker running on the Raspberry Pi.
We can use the Mosquitto client for subscribers that we installed earlier to do this.
In our example below, we connect to a localhost connection and wait for messages from the broker on the “cstutoring/chatroom” topic.
```
mosquitto_sub -h localhost -t "cstutoring/chatroom"
```

Using the “-h” argument, you can specify the hostname you want to connect to. In our case, we are using the local MQTT broker that we installed on our Raspberry Pi.
Next, we use the “-t” argument to tell the Mosquitto subscriber what topic we should listen to from the MQTT broker.

For our example, we are listening to a topic called “cstutoring/chatroom“.

2. Now that we have a client loaded up and listening for messages, let us try publishing one to it.
We need to use the MQTT publisher client that we installed on our Raspberry Pi earlier to publish a message to the topic.
In your second terminal window or a second SSH session, run the following command to publish the message “Hello World” to our localhost server under the “cstutoring/chatroom” topic.
```
mosquitto_pub -h localhost -t "cstutoring/chatroom" -m "Hello world"
```
Two of the arguments are the same as the previous command, with “-h” specifying the server to connect to and “-t” specifying the topic to publish to.
The one additional argument that we are using here is the “-m” argument. This argument allows you to specify the message you want to send to the Raspberry Pi MQTT broker.

3. Back in the terminal session where you started the Mosquitto subscriber, you should now see your message appear.
So if you were following our example, you should see the following text appear in the command line.
Hello world

## Testing the Mosquitto Installation from a Remote Computer
1. On a different computer, install another MQTT client. For example,
- on macOS, you may install the same client software with the command
```
brew install mosquitto
```
- on Ubuntu, you install the mosquitto-clients package as follows:
```
sudo apt install mosquitto-clients
```
- on Windows, you may install a Linux VM and follow the instructions above

2. Now try to run the same test as before, but from this new computer to send a message to the RPi MQTT broker
```
mosquitto_pub -h rpi.local -t "cstutoring/chatroom" -m "Hello RPi from another computer"
```
Where rpi.local is the name of your host.local and can be replaced by your RPi IP address. 

If you followed all the instructions, your message does not display in the window running the topic subscriber. This is because the MQTT server does not allow connections from outside the device, i.e., connection NOT originating from localhost

3. We will configure the MQTT server by running the following command in a RPi terminal or SSH session to the RPi:
```
sudo nano /etc/mosquitto/mosquitto.conf
```
At the bottom of the file add the following lines:
```
listener 1883
allow_anonymous true
```
Save and exit by pressing CTRL-O, followed by CTRL-X.

4. Now restart the mosquitto service using the following command:
```
sudo systemctl restart mosquitto
```
5. Try running the message publish instruction from the remote computer once more as follows:
```
mosquitto_pub -h rpi.local -t "cstutoring/chatroom" -m "Hello RPi from another computer"
```
Where rpi.local is the name of your host.local and can be replaced by your RPi IP address. 
Now you should see your message appear.

## TODO: Secure the installation by disallowing anonymous connections and setting user agent passwords
