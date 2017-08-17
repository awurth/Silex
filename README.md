# Silex skeleton

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/ace47319-1c62-4a1b-a0d4-1274e6a6d887/mini.png)](https://insight.sensiolabs.com/projects/ace47319-1c62-4a1b-a0d4-1274e6a6d887)

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
This will create a `lib/` folder in `web/` for jQuery and Semantic UI

##### Install Gulp globally
``` bash
$ npm install -g gulp-cli
```

##### Run watcher to compile SASS and Javascript
``` bash
$ gulp
```
You may have to edit the files in `src/App/Resources/assets/` while running gulp for the first time to generate the static `css` and `js` files

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
