# Setting up Raspbian to Connect to PC over Bluetooth

## Raspbian Setup

From [https://raspberrypi.stackexchange.com/questions/29504/how-can-i-set-up-a-bluetooth-pan-connection-with-a-raspberry-pi-and-an-ipod](https://raspberrypi.stackexchange.com/questions/29504/how-can-i-set-up-a-bluetooth-pan-connection-with-a-raspberry-pi-and-an-ipod)

Here's how you can setup a bluetooth PAN on Raspbian.

From the command line, run:
```
sudo apt-get install bluez-tools
```

Create the 4 following files:

1) To define the network device that will be used to connect on PAN, write the file `/etc/systemd/network/pan0.netdev`:

(For example, at the prompt, write `sudo nano /etc/systemd/network/pan0.netdev`)

```
[NetDev]
Name=pan0
Kind=bridge
```

2) To define the network parameters, write the file `/etc/systemd/network/pan0.network`. In this file, note that we are setting up the IP addesss of the RPi for the connection over Bluetooth. Take not of this IP address.

```
[Match]
Name=pan0

[Network]
Address=10.1.1.1/24
DHCPServer=yes
```

3) To define the service invocation that will authenticate bluetooth users, write the file `/etc/systemd/system/bt-agent.service`

```
[Unit]
Description=Bluetooth Auth Agent

[Service]
ExecStart=/usr/bin/bt-agent -c NoInputNoOutput
Type=simple

[Install]
WantedBy=multi-user.target
```

4) To define the service invocation for the network services write the file `/etc/systemd/system/bt-network.service`

```
[Unit]
Description=Bluetooth NEP PAN
After=pan0.network

[Service]
ExecStart=/usr/bin/bt-network -s nap pan0
Type=simple

[Install]
WantedBy=multi-user.target
```

Once you have written your 4 files, you will be ready to activate the services and make them persistent through every reboot. Note that we will use another service that is already defined on Raspbian, systemd-networkd, so we did not have to write this `.service` file.

To start and test the services, first run the 3 following commands
```
sudo systemctl start systemd-networkd
sudo systemctl start bt-agent
sudo systemctl start bt-network
```

If you did everything right, no errors will be produced and you can continue, making the services persistent as follows:
```
sudo systemctl enable systemd-networkd
sudo systemctl enable bt-agent
sudo systemctl enable bt-network
```

Finally to enable Bluetooth pairing, run the following command:

```
sudo bt-adapter --set Discoverable 1
```

## Mac OS Setup

In this section, all operations are done on a mac.

From the mac, open **System Preferences...**, click **Networks**.
If the list of networks contains **Bluetooth PAN**, then skip to the next step.
Otherwise, press **+** at the bottom of the list, in the **Interface** dropdown list, select **Bluetooth PAN** and press **Create**.

Click the back arrow to get back to the main menu for the **System Preferences...***
Click **Sharing**.
From the **Service** list, ensure that **Internet Sharing** is checked and selected.
From the **To computers using: Ports** list, make sure **Bluetooth PAN** is checked.
Close the window.

To pair the mac and the RPi, click the Bluetooth icon, click **Open Bluetooth Preferences...***, click or right-click your RPi unit name (maybe wait a bit for it to appear in the list) and click **Connect**.
The Bluetooth icon should now show with **...** across it.
Click on the Bluetooth icon again, hover over the RPi device name and select **Connect to Network**.

## PC Setup

In this section, all operations are run on a Windows PC.

To pair the PC and the RPi, click or right-click the Bluetooth icon and click **Add a Bluetooth device**, select your RPi and connect.
Click or right-click the Bluetooth icon and click **Join a Personal Area Network**.
From the device list presented, right-click your RPi device, click **Connect using** and then **Access point**.

(Section to be validated)

## Conclusion

Within a few seconds, you should be able to connect to the RPi through its hostname.local or IP address (set up in `/etc/systemd/network/pan0.ntwork` above.

You may SSH and or VNC into the RPi, as previously configured.

