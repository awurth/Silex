# Silex skeleton

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/ace47319-1c62-4a1b-a0d4-1274e6a6d887/mini.png)](https://insight.sensiolabs.com/projects/ace47319-1c62-4a1b-a0d4-1274e6a6d887) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/awurth/silex/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/awurth/silex/?branch=master)

This is an app skeleton for the Silex PHP Micro-Framework to get started quickly

## Features
- [Doctrine ORM](http://www.doctrine-project.org/projects/orm.html) ([Doctrine ORM Service Provider](https://github.com/dflydev/dflydev-doctrine-orm-service-provider))
- CSRF protection ([CSRF Service Provider](https://silex.symfony.com/doc/2.0/providers/csrf.html))
- Security ([Security Service Provider](https://silex.symfony.com/doc/2.0/providers/security.html)) and user management ([Silex User Service Provider](https://github.com/awurth/silex-user))
- Validation ([Validator Service Provider](https://silex.symfony.com/doc/2.0/providers/validator.html))
- Twig ([Twig Service Provider](https://silex.symfony.com/doc/2.0/providers/twig.html))
- CSS Framework [Semantic UI](https://github.com/Semantic-Org/Semantic-UI)
- A **Gulpfile** with a watcher for *SASS* and *JS* files, and minification
- Logs ([Monolog](https://github.com/Seldaek/monolog))
- [Symfony Web Profiler](https://github.com/silexphp/Silex-WebProfiler)
- Console commands for updating the database schema and creating users
- Functionnal tests base ([PHPUnit](https://github.com/sebastianbergmann/phpunit))

## Installation
### Create project using Composer
``` bash
$ composer create-project awurth/silex [project-name]
```

### Setup environment variables
Copy `.env.dist` to a `.env` file and change the values to your needs. This file is ignored by Git so all developers working on the project can have their own configuration.

### Download client-side libraries
``` bash
$ npm install
```
This will install Gulp dependencies in `node_modules/` and Semantic UI in `public/assets/lib/semantic/`.

### Gulp
This boilerplate uses Gulp to manage assets. The CSS and Javascript files are located in `assets/`, so you have to use Gulp after creating your project to generate the files in `public/`, which will be ignored by Git.

#### Install Gulp
You can install Gulp globally on your system with the following command if you haven't done it yet
``` bash
$ npm install -g gulp-cli
```

#### Generate assets
If you just want to generate the default CSS and JS that comes with this skeleton, run the following command
``` bash
$ gulp build
```

If you want to run a watcher and begin coding, just run
``` bash
$ gulp
```

### Setup cache files permissions
The skeleton uses a cache system for Twig templates, translations, Doctrine, the web profiler and the Monolog library for logging, so you have to make sure that PHP has write permissions on the `var/cache/` and `var/log/` directories.

### Update your database schema
``` bash
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:update --force
```

If you're using [Oh My Zsh](https://github.com/robbyrussell/oh-my-zsh), you can install the symfony2 plugin, which provides an alias and autocompletion:
``` bash
# Without Symfony2 plugin
$ php bin/console doctrine:database:create

# With Symfony2 plugin
$ sf doctrine:database:create
```
