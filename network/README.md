# Setting Up Wireless Networking

Boot the Raspberry Pi, connect to it via SSH, VNC, (via USB or Ethernet) or with a display and a keyboard. If in the desktop environment, open a terminal window. Edit the network interfaces file with the following command:

```
$ sudo nano /etc/network/interfaces
```

This file contains known network interfaces, it should contain come configurations. Before any other content in the file, if any, add:

```
auto wlan0
```

Then at the end of the file, append these lines:
```
allow-hotplug wlan0
iface wlan0 inet dhcp
wpa-conf /etc/wpa_supplicant/wpa_supplicant.conf
iface default inet dhcp
```
These lines instruct the Raspberry Pi OS to allow wlan as a network connection method and use the /etc/wpa_supplicant/wpa_supplicant.conf as your configuration file.
To save the changes, press ctrl-O, followed by ctrl-X.

Next, we create or modify the wpa_supplicant.conf file mentioned above. Run

```
$ sudo nano /etc/wpa_supplicant/wpa_supplicant.conf
```

Some lines might already be present, just add the following lines as an example.

```
country="CA"
network={
	ssid="networkname"
	psk="networkpassword"
	proto=RSN
	key_mgmt=WPA-PSK
	pairwise=CCMP
	auth_alg=OPEN
}
```

All parameters are network-specific, i.e., you will need to adjust them to the configuration of the WiFi network to which we wish to connect.

- `ssid` is the name of the wireless network you wish to connect to
- `psk` is the network password. To avoid writing the network password in plain text, see the secion on `wpa_passphrase`
- `country` needs to be set to your country's ISO code (CA for Canada, US for USA, etc.)
- `proto` could be either `RSN` (WPA2) or `WPA` (WPA1).
- `key_mgmt` could be either `WPA-PSK` (most probably) or `WPA-EAP` (enterprise networks, see the section on enterprise networks below)
- `pairwise` could be either `CCMP` (WPA2) or `TKIP` (WPA1)
- `auth_alg` is most probably `OPEN`, other options are `LEAP` and `SHARED`

## `wpa_passphrase`

To avoid writing the WiFi network password in plain text in your configuration files, use the wpa_passphrase command at the CLI as follows:

```
$ wpa_passphrase networkname networkpassword
```

Where networkname is the network ssid and networkpassword is the network ssid as previously written. The utility will then return a message such as the following:

```
network={
	ssid="networkname"
	#psk="networkpassword"
	psk=62baa1ca072490418d9331603393d75c300782af3ab50b5a5a67c67f8327f00c
}
```

To hide your network psk you must then remove the existing psk entry and replace it by the newly generated one, `psk=62baa1ca072490418d9331603393d75c300782af3ab50b5a5a67c67f8327f00c` above.

Our example becomes

```
country="CA"
network={
	ssid="networkname"
	psk=62baa1ca072490418d9331603393d75c300782af3ab50b5a5a67c67f8327f00c
	proto=RSN
	key_mgmt=WPA-PSK
	pairwise=CCMP
	auth_alg=OPEN
}
```

## Enterprise Networks

Certain WiFi networks require username and password information to authenticate users and allow them to connect to the network. In this case, our wpa_supplicant.conf file must be modified to use the proper key management by changing `key_mgmt` to `WPA-EAP`, adding the `identity` entry for the username, and replacing the `psk` entry by a `password` entry.

Our example becomes

```
country="CA"
network={
	ssid="networkname"
	identity="username"
	password="password"
	proto=RSN
	key_mgmt=WPA-EAP
	pairwise=CCMP
	auth_alg=OPEN
}
```

To be validated:

To hide your password, you may be able to use 
```
echo -n plaintext_password_here | iconv -t utf16le | openssl md4
```
to generate a hashed string such as
```
(stdin)= 6602f435f01b9173889a8d3b9bdcfd0b
```
that you then enter into your wpa_supplicant.conf by replacing the plain text password by hash:[that long hashed string after (stdin)= ] in the file as follows
```
country="CA"
network={
	ssid="networkname"
	identity="username"
	password=hash:6602f435f01b9173889a8d3b9bdcfd0b
	proto=RSN
	key_mgmt=WPA-EAP
	pairwise=CCMP
	auth_alg=OPEN
}
```

## Using the Connection client

Raspberry Pi Desktop now supports connections to Enterprise networks using its GUI.
To know which options to select is the challenge.

You may find information about your enterprise connection on Windows:
1. Click on the network connection button at the bottom left.
2. Click on the Wifi confguration `>` at the top left of the popup.
3. Click on the `i` information icon at the top right of your current connection. A dialog with information will open.
4. Note the `Security type` entry and use this to populate the `Wi-Fi Security` entry on your Linux computer.
5. Note the `Type of sign-in info` entry and use this to populate the `Authentication` entry on Linux.
6. If you were initially able to connect without installing a certificate (you would know), click the checkbox left of `No CA certificate is required`
7. Enter your `Username` and `Password` as you did on your Windows computer.
8. Click `Connect`

The Raspberry Pi SBC or Linux computer should connect.
