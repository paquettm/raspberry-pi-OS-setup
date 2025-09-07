# Connect to Your Raspberry Pi Over USB Using Gadget Mode

Raspberry Pi Gadget Mode allows you to connect to your Raspberry Pi device through a network link layered on a USB connection. You can then SSH over to the unit and control it with your development computer keyboard to accomplish much much more.

These guidelines work for Raspberry Pi 4 and remain untested for other versions.

You will need a USB cable with power and data support to connect to the power port of your Raspberry Pi. 

We will start after you have flashed your Raspberry Pi OS onto your SD card.

With Raspberry Pi OS installed on the SD card (and the SD card still mounted on your computer), navigate to the boot directory.

## 1-Edit `config.txt`

Edit the file called config.txt by appending the following:

```
dtoverlay=dwc2
```

## 2-Enable SSH

Enable SSH server by adding an empty file called ssh directly in the boot directory.

In Linux: `touch ssh`
In Windows CLI: copy con ssh <ENTER> ctrl-z <ENTER>

The file must be called "ssh" without uppercase letters and extensions.

## 3-Edit `cmdline.txt`

Edit the file called cmdline.txt. Look for `rootwait`, and add `modules-load=dwc2,g_ether` immediately after. There should be one space before this string and one space after, no lines skipped. The formatting of cmdline.txt is strict with only spaces separating commands.

## 4-Eject

Eject the SD card, and insert it into the the Raspberry Pi.

## 5-Connect the RPi

Using a USB cable, connect to the Raspberry Pi from your computer.

After the Raspberry Pi boots up (wait until the green light stops flashing), it should appear as a USB Ethernet gadget device. If it worked for you, skip ahead to the next section.

Often, in Windows, we don't see the device appear because we need a new driver installed.
To update the device driver, you need administrative privileges.
Proceed as follows
1- Search for and open the `Device Manager`
2- Disconnect the device and look for the "ports" section and remember the ports listed, if any.
3- Reconnect the device and look for the new port. Right click to see the properties.
4- Right click it, select properties, then the Details tab. In the Property input, select "Hardware Ids". The Value should read something like `USB\VID_0525&PID_A4A2`
5- Go get the correct driver:
a) Open a new internet browser window and go to "https://www.catalog.update.microsoft.com".
b) In the search box enter your Hardware Ids value as above without the USB\ and &, for example: "VID_0525 PID_A4A2".
c) On the line for your OS version, click download.
d) In the new window, click on the hyperlink to download the correct cab file.
e) Open the cab file and extract the files to a known location.
6- Go back to Device Manager, select the Driver tab for the previously found device and click "Update driver". Select the option to provide your driver and navigate to the folder containing your new driver files. You should be provided with a USB Ethernet RNDIS Gadget or something simimlar choice. Select it and be happy.

## Connecting to the Raspberry Pi over SSH

Open a terminal window in any OS, and you can SSH into your Raspberry Pi using
```
ssh accountname@pihostname.local
```
where accountname is the name of your user account on the Raspberry Pi and pihostname is the hostname given to the Raspberry Pi.
