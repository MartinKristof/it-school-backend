# IT-course backend

Source code of backend of school [IT courses project](https://github.com/MartinKristof/it-courses-school)


## Requirements
- Command line (CLI)
- [Install Docker](https://docs.docker.com/install/)
- [PHP 7.1+](https://launchpad.net/~ondrej/+archive/ubuntu/php)
- [Composer](https://getcomposer.org/download/)
- [Git](https://git-scm.com/download/linux)

## Installation

### 1. Install GIT
- [Get Git for you OS](https://git-scm.com/download/linux)

### 2. Clone repository

```bash
git clone https://github.com/MartinKristof/it-school-backend.git
```

### 3. Go to project folder

```bash
cd it-school-backend
```

### 4. Install docker
* Install [Docker for your OS](https://docs.docker.com/install/)

### 5. Install PHP 7.1
* Install [PHP 7.1+](https://launchpad.net/~ondrej/+archive/ubuntu/php) for your OS

### 6. Install Composer
* Install [Composer for your PS](https://getcomposer.org/download/)

## Build

### 7. Install PHP dependencies via composer
- run command via CLI on project directory:
```bash
composer
```

### 8. Compose up
#### Turn on
- run command via CLI on project directory:
```bash
docker-compose up
```
- It will run MySQL and PHPMyAdmin on URL http://localhost:789/ (username: root, password: root)
#### Shut down
#### 
```bash
docker-compose down
```

## Dev server

### 9. Start server
- run command via CLI on project directory:
```bash
bin/console server:start
```
- install pcntl extension if needed
- it will show URL of symfony application to console

Restart server
- run command via CLI on project directory:
```bash
bin/console server:restart
```

Stop server
- run command via CLI on project directory:
```bash
bin/console server:stop
```

Get status of server
- run command via CLI on project directory:
```bash
bin/console server:status
```
