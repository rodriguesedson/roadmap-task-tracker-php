# roadmap-task-tracker-php
Beginner backend project "Task Tracker" from roadmap.sh made in php

[Link to the project description at roadmap.sh](https://roadmap.sh/projects/task-tracker)

## Configuration - Install php
- in order to use this project you'll need to install php wherever you'll run it.
- on windows (powershell): `winget install php.php.8.5`
- on linux: 
```
sudo apt install software-properties-common -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update

# Instalar a versão desejada (exemplo com 8.3)
sudo apt install php8.3 -y
```

## Starting
- execute `php main.php` (watch for the path of this file)
- ps.: when you start for the first time it will create a directory "data" with a file "tasks.json" where all the tasks will be saved (it's a requirement of the project)

## Commands
- exit
- clear
- add :description
- update :taskId :description
- mark-in-progress :taskId
- mark-done :taskId
- delete :taskId
- list in-progress
- list todo
- list done
- list
