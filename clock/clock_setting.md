# Setting the hardware clocks using Linux CLI

Read the hardware clock.

```
hwclock -r
```

Read the system clock.

```
date
```

Set the system clock.

```
date --set="29 APR 2024 10:33:00 EDT"
```

Set the hardware clock to the system clock.

```
hwclock --systohc
```

Read the hardware clock.

```
hwclock -r
```
