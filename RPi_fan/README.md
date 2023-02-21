# Cooling a Raspberry Pi with a small fan

Connect a fan's +5V lead to the +5v header, gnd to gnd, and PWM to pin 18. If you choose a pin other than 18, change the pin number in the program below.

The following program runs in python, reads the cpu temperature every second, calculates a fan duty cycle to bring the temperature down to 50Celcius and sets the pin 18 output to this PWM duty cycle.

```
import os
import time
import RPi.GPIO as GPIO

# Set BCM18 as the fan pin
fan_pin = 18
GPIO.setmode(GPIO.BCM)
GPIO.setup(fan_pin, GPIO.OUT)

# Set the PWM frequency and initialize the PWM output
pwm_frequency = 25
pwm = GPIO.PWM(fan_pin, pwm_frequency)
pwm.start(0)

# Set the target temperature and initialize the PID parameters
target_temp = 50
kp = 1
ki = 0.1
kd = 0.01
integral = 0
previous_error = 0

# Function to read the temperature of the CPU
def get_cpu_temp():
    with open("/sys/class/thermal/thermal_zone0/temp", "r") as temp_file:
        return float(temp_file.read().strip())/1000

# Function to update the fan duty cycle with the PID controller
def update_fan_duty_cycle(error):
    global integral, previous_error

    integral += error
    derivative = error - previous_error
    previous_error = error

    return kp * error + ki * integral + kd * derivative

# Main loop
while True:
    cpu_temp = get_cpu_temp()
    print("CPU temperature:", cpu_temp)

    error = cpu_temp - target_temp
    print("Error:", error)
    duty_cycle = update_fan_duty_cycle(error)

    if duty_cycle > 100:
        duty_cycle = 100
    elif duty_cycle < 0:
        duty_cycle = 0

    print("Duty Cycle:", duty_cycle)
    pwm.ChangeDutyCycle(duty_cycle)

    time.sleep(1)
```

To run this program in the background from startup on your Raspberry Pi running Raspberry Pi OS, you can create a system service that runs the program at boot time. Here's an example of how to do this:

Create a script file for the service:

```
sudo nano /etc/systemd/system/fan-controller.service
```

Copy the following content into the file and save it:

```
[Unit]
Description=Fan Controller Service
After=multi-user.target

[Service]
ExecStart=/usr/bin/python /path/to/fan-controller.py
WorkingDirectory=/path/to/
StandardOutput=inherit
StandardError=inherit
Restart=always
User=pi

[Install]
WantedBy=multi-user.target
```
Replace /path/to/fan-controller.py with the actual path to the Python script file containing your fan controller program.

Reload the system manager configuration:
```
sudo systemctl daemon-reload
```
Enable the fan controller service to run at startup:
```
sudo systemctl enable fan-controller.service
```
Start the fan controller service:
```
sudo systemctl start fan-controller.service
```
Verify that the service is running:
```
sudo systemctl status fan-controller.service
```
Now, the fan controller program will run in the background from startup on your Raspberry Pi. You can check the status of the service and troubleshoot any issues using the systemctl commands.
