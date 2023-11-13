This procedure outlines how to SSH into a Raspberry Pi, install SQLiteBrowser using command line instructions, VNC into the Raspberry Pi, and use SQLiteBrowser.

We assume that you have configurs VNC suppport already.

## Accessing Raspberry Pi and Installing SQLiteBrowser

1. **SSH into Raspberry Pi:**

    To access your Raspberry Pi via SSH, you need to know its IP address. Open a terminal on your local machine and use the following command:

    ```shell
    ssh pi@<raspberry_pi_ip_address>
    ```

    Replace `<raspberry_pi_ip_address>` with the actual IP address of your Raspberry Pi. You'll be prompted for the Raspberry Pi's password.

2. **Install SQLiteBrowser:**

    Once you're connected to the Raspberry Pi, you can install SQLiteBrowser using the following commands:

    ```shell
    sudo apt update
    sudo apt install sqlitebrowser
    ```

    This will update the package list and install SQLiteBrowser on your Raspberry Pi.

## VNC into Raspberry Pi

3. **VNC Connection:**

    On your local machine, you can use a VNC client (e.g., RealVNC Viewer) to connect to your Raspberry Pi using its IP address. You'll be prompted for the Raspberry Pi's login credentials.

## Using SQLiteBrowser

4. **Open SQLiteBrowser:**

    On your Raspberry Pi, you can open SQLiteBrowser either from the desktop environment or by running the following command in your terminal:

    ```shell
    sqlitebrowser
    ```

5. **Using SQLiteBrowser:**

    SQLiteBrowser is a user-friendly GUI tool for managing SQLite databases. To open a database, go to `File > Open Database`, and then browse to the location of your SQLite database file. Once opened, you can view, edit, and execute SQL queries on the database using the intuitive interface.

    For more information on using SQLiteBrowser, you can refer to the official documentation or online tutorials specific to your use case.
