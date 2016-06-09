# Guarantee monitor App

Guarantee monitor App is an basic Symfony based App that can check guarantee end and send information to slack

It has three basic management view

* homepage                   - device management (add, edit)

Console action for cron task

php bin/console guarantee:check

Example of cron task config (it could be diffent because of server you use):

*/5 * * * * php php bin/console guarantee:check

run every 5 minutes

### Version
1.0

### Tech

Guarantee monitor App uses a number of open source projects to work properly:

* [Symfony 3]         - PHP framework
* [Doctrine 2]        - Object Relational Mapper (ORM)
* [Assetic bundle]    - provides integration of the Assetic library into the Symfony framework.
* [Twitter Bootstrap] - great UI boilerplate for modern web apps


### Installation

You need composer to install all dependecies globally:

Unpack files from app.zip then run:

```sh
$ php composer install
$ create empty database named guarantee
$ php bin/console doctrine:schema:update --force
$ php bin/console assetic:dump
```

License
----

MIT

[Doctrine 2]: <https://github.com/doctrine/doctrine2>
[Symfony 3]: <https://github.com/symfony/symfony>
[Twitter Bootstrap]: <http://twitter.github.com/bootstrap/>
[Assetic]: <https://github.com/symfony/assetic-bundle>


