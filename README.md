# IT-course backend

Source code of backend of school [IT courses project](https://github.com/MartinKristof/it-courses-school)


## Requirements

- [PHP 7.1+](https://launchpad.net/~ondrej/+archive/ubuntu/php)
- [Composer](https://getcomposer.org/download/)
- [Git](https://git-scm.com/download/linux)

## Installation

### Clone repository

```bash
git clone git@github.com:MartinKristof/it-school-backend.git
```

### Go to project folder

```bash
cd it-school-backend
```

### Install PHP dependencies

```bash
composer prod
```

## Dev server

Install PHP dependencies with dev dependencies

```bash
composer dev
```

Start server

```bash
bin/console server:start
```

Restart server

```bash
bin/console server:restart
```

Stop server

```bash
bin/console server:stop
```

Get status of server

```bash
bin/console server:status
```
