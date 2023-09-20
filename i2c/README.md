# Using i2c with Raspberry Pi in Python

## Install Python Dependencies

In a terminal type

```
pip3 install smbus
```

To add the smbus library support for Python globally on the RPi OS.

## Enable I2C

In the terminal, type `raspi-config`, navigate to the `Interfaces` and enable I2C.

## Testing

If you already have I2C devices attached to your RPi, you may find them with the

```
sudo i2cdetect -y <i2c_bus_number>
```
command. If your devices are connected on bus 1 (SDA and SCL at pins 3 and 5), then you would type

```
sudo i2cdetect -y 1
```
which would show you the addresses of the I2C devices connected to your RPi I2C bus 1.
