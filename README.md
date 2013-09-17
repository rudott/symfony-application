Endroid Symfony Application
===========================

Demo
----

[`symfony-application.endroid.nl`](http://symfony-application.endroid.nl/)
[`symfony-application.endroid.nl/admin/dashboard`](http://symfony-application.endroid.nl/admin/dashboard) (admin/admin)

Installation
------------

    mkdir app/cache app/logs web/uploads

    sudo setfacl -R -m u:www-data:rwX -m u:`whoami`:rwX app/cache app/logs web/uploads
    sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs web/uploads

    (configure parameters.yml)

    curl -s http://getcomposer.org/installer | php
    php composer.phar install

    php app/console doctrine:database:create
    php app/console doctrine:schema:update --force
    php app/console doctrine:fixtures:load -n
    php app/console assets:install --symlink
    php app/console fos:elastica:populate

ElasticSearch
-------------

In case you want to use ElasticSearch as your search engine, make sure the
search engine is installed and running. For more information on installing
ElasticSearch read the [`installation guide`](http://www.elasticsearch.org/guide/reference/setup/installation/).
