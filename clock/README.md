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

