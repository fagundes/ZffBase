Contribuing
=============================

If you want to help this project, you should read this instruction to know better how to do that.

There are a lot to do here: documentation, unit tests, new features, suggestions, report issues and solve issues. 
Btw, you can check our [issues](https://github.com/fagundes/ZffBase/issues) list.

## Composer

The [composer](http://getcomposer.org) is a manager dependency tool for PHP projects. With it is possible to install
all libs a software need and with a single command.

## Code style

Any code change MUST follow [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md).

The [PHP_CodeSniffer](https://github.com/squizlabs/php_codesniffer) is used to help us detect and fix violations of a defined set of coding standards.

CodeSniffer can be installed using composer, and it's a dev dependency to this project.

## git-flow

[git-flow](https://github.com/nvie/gitflow) is a very useful tool to help improve your development using branchs.

The original post which inspired this git extension can be readed [here](http://nvie.com/posts/a-successful-git-branching-model).

## Good to go!

Are you ready to make some code? Great! Follow these steps:

1. Do a [fork](https://help.github.com/articles/fork-a-repo) and do a local clone of your fork;
- Resolve dependencies using composer ```composer install```;
- Initialize the git-flow (```git flow init -d```);
- Create your branch
    * If you want to create a new feature you should execute the commmand 
      ```git flow feature start $feature```, where $feature
      is an name id for your new feature;
    * If you want to fix a bug you should initialize a hotfix branch
      ```git flow hotfix start $hotfix```, where $hotfix must be the current version,
        incrementing the last number (PATH).

If you want to know more versioning, read more [here](http://semver.org/spec/v2.0.0.html).