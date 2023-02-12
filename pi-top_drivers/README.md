# Pi-Top 3 device configuration on Raspberry Pi OS

Add the source repositories for the drivers
```
sudo apt update
sudo apt install -y pi-top-os-apt-source
```

Update again 
```
sudo apt update
```

Install the drivers

```
sudo apt install -y pt-device-support
```

## Turning off and on the touchpad

List your inputs with
```
sudo xinput list

```

Find the mouse or touchpad and note the id property value. We will use this value later.

To disable the touchpad, for example, for id=8 use

```
sudo xinput --disable 8
```

To enable the touchpad, for id=8, run
```
sudo xinput --enable 8
```

Create 2 scripts, touchon and touchoff, containing these instructions. Make these executable with
```
chmod +x touchon
chmod +x touchoff
```

Add the xbindkeys and xbindkeys config packages to allow running these scripts with key combinations.

```
sudo apt install xbindkeys xbindkeys-config
```
Create the configuration by running the folowing commands
```
xbindkeys -d > .xbindkeysrc
nano .xbindkeysrc
```

Open another terminal and run `xbindkeys --multikey` to discover the key codes to write into the configuration file.

For an example output

```
"(Scheme function)"
    m:0xe + c:45
    Control+Alt + k
```

Copy the 2 first lines to the configuration file and replace the (Scheme function) mention by the command to run.

For example, to bind the scripts specified above to CTRL+ALT+o and CTRL+ALT+i, the folowing was added to .xibindkeysrc:
```
"~/touchoff"
    m:0xc + c:32
"~/touchon"
    m:0xc + c:31
```

to test the shortcuts run 

```
xbindkeys
```

To make the canges permanent and global run the command

```
sudo nano /etc/X11/xinit/xinitrc
```
and add the command xbindkeys before the last command that invokes the window system.


all details found [here](https://wiki.archlinux.org/title/Xbindkeys).

