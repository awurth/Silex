# Silex skeleton

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/ace47319-1c62-4a1b-a0d4-1274e6a6d887/mini.png)](https://insight.sensiolabs.com/projects/ace47319-1c62-4a1b-a0d4-1274e6a6d887) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/awurth/silex/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/awurth/silex/?branch=master)

> This is a skeleton for the Silex PHP Micro-Framework to get started quickly

## Installation
### 1. Create project using Composer
``` bash
$ composer create-project awurth/slim [app-name]
```

### 2. Download bower and npm dependencies
``` bash
$ bower install
$ npm install
```
This will create a `lib/` folder in `web/assets/` for jQuery and Semantic UI

##### Install Gulp globally
``` bash
$ npm install -g gulp-cli
```

##### Run watcher to compile SASS and Javascript
``` bash
$ gulp
```

This will compile and watch all SASS and JS files and put the result in the `web/assets/` folder

### 3. Setup permissions
You will have to give write permissions to the `var/cache/` and `var/logs` folders
``` bash
$ chmod 777 var/cache var/logs
```

### 4. Create database and tables
``` bash
$ php console doctrine:database:create
$ php console doctrine:schema:update --force
```

You can set the `console` file executable to call it directly
``` bash
$ chmod a+x console
$ ./console [command]
```
