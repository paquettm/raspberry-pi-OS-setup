#Python installation

Python should be installed natively

## Upgrade python to latest

* Run `sudo apt install python3` to install the latest available version of Python 3.

##pyenv installation

* Run `curl https://pyenv.run | bash`

Append the following to the end of .bash_profile if it exists or to .bashrc and .profile

```
export PYENV_ROOT="$HOME/.pyenv"
command -v pyenv >/dev/null || export PATH="$PYENV_ROOT/bin:$PATH"
eval "$(pyenv init -)"
```

exit all shells
return to a shell

##pipenv installation

* Run `pip install pipenv`

## But what if I don't even have pip?
Update your libraries by running
```
sudo apt update
```
Then install the pip3 program with
```
sudo apt install python3-pip
```
Verify the installation
```
which pip3
```
which should return the install pah such as
```
/usr/bin/pip3
```

## Thonny

Thonny is a great little editor for Python that supports Python, MicroPython, as well as virtual environments.
Thonny has its own package manager that can `pip install` packages in your environment(s).

If you had previously installed Thonny, you may uninstall it via
```bash
sudo apt remove thonny
```
or
```bash
pip remove thonny
```

To install the latest version, do not use apt or pip. Instead, get the installer from the source as follows, at the bash terminal:
```bash
bash <(wget -O - https://thonny.org/installer-for-linux)
```

Thonny should be installed and accessible from the GUI.
To make it runnable from the command prompt, you may also add it to the path as follows:
```bash
echo 'export PATH="$PATH:$HOME/apps/thonny/bin"' >> ~/.bashrc
source ~/.bashrc
```

Confirm the functionality by running thonny from the command line as follows:
```bash
thonny
```
