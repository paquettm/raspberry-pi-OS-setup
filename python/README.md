#Python installation

Python should be installed natively

## Upgrade python to latest

* Run `sudo apt install python3.9` to install Python 3.9.

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
