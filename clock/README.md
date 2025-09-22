# Setting NTP servers for closed networks

Some closed network environments may have a dedicated NTP endpoint available and block the NTP port for all other addresses.

For example, let's imagine your network has a NTP server on its intranet with the name `DC1.VanierCollege.intra`.
If you don't know which NTP server your network is using, go to the other section and then come back.

To set up your Linux OS to use this intranet service as a time source, we will use a comand-line terminal.
Press the `CTRL-ALT-T` key combination to open a terminal window.

We start by editing the time synchronisation configuration, using an editor, such as nano:
```
sudo nano /etc/systemd/timesyncd.conf
```

Find the lines starting with NTP and FallbackNTP.
You will probably find lines similar to the following, commented out with a #:
```
#NTP=
#FallbackNTP=0.debian.pool.ntp.org 1.debian.pool.ntp.org 2.debian.pool.ntp.org 3.debian.pool.ntp.org
```

Uncomment these lines and replace the default pool servers with your desired NTP server(s). For example, to use `DC1.VanierCollege.intra` as the primary the default servers as fallback:
```
NTP=DC1.VanierCollege.intra
FallbackNTP=0.debian.pool.ntp.org 1.debian.pool.ntp.org 2.debian.pool.ntp.org 3.debian.pool.ntp.org
```

Save the changes.
In nano, this is done with the `CTRL+O` combination and then pressing the `ENTER` key.
Then exit the editor.
In nano, this is done with the `CTRL+X` combination.

Next, restart the network time synchronisation service as follows:
```
sudo systemctl restart systemd-timesyncd
```

The clock should now be synchronised and should remain synchronised when connected to your network or other networks that are not buttoned down.

You may check the NTP servers with the command
```
timedatectl show-timesync
```

Note that if you access many such networks with your device, you may add a full list of these servers in the FallbackNTP line.

## How do I know which NTP server to use?

Windows computers that connect to your network should have the setting in their configurations.

To find out which server to use, start by opening a Command Prompt as follows:
1. Press the Windows button or click the Windows icon (AKA Start menu).
2. Type "cmd".
3. Press enter or click the "Command Prompt" result.
4. At the command prompt enter `w32tm /query /status` and press the `ENTER` key.

You should see something similar to the following, with data on each line, replacing the ... in the output below:
```
Leap Indicator: ...
Stratum: ...
Precision: ...
Root Delay: ...
Root Dispersion: ...
ReferenceId: ...
Last Successful Sync Time: ...
Source: DC1.VanierCollege.intra
Poll Interval: ...
```

Your NTP server name will be the one on the `Source:` line.

# Unverified

If you just want a command you can run from the command line once you have a network connection you can use this to set you pi clock.

```
sudo date -s "$(wget -qSO- --max-redirect=0 google.com 2>&1 | grep Date: | cut -d' ' -f5-8)Z"
```

# Setting the hardware clocks using Linux CLI

## Under Ubuntu

Operate as root:

```
sudo su
```
enter your root password if requested.

Read the hardware clock.

```
hwclock -r
```

Read the system clock.

Install software as proposed if the package is not installed:
```
apt install util-linux-extra
```
Use the followinf command to get the Operating System date:
```
date
```

Set the system clock as follows. Do change the date string to match the curent date and time and add AM or PM if using 12-hour format.

```
date --set="29 APR 2024 10:33:00 EDT"
```

Set the hardware clock to the system clock.

```
hwclock --systohc
```

Read the hardware clock to confirm the right time is set.

```
hwclock -r
```
## Under Raspberry Pi OS

... there is no hardware clock, so the hwclock instructions will not work.

