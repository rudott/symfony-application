# Endroid Symfony Application

[![Latest Stable Version](https://poser.pugx.org/endroid/symfony-application/v/stable.png)](https://packagist.org/packages/endroid/symfony-application)
[![Total Downloads](https://poser.pugx.org/endroid/symfony-application/downloads.png)](https://packagist.org/packages/endroid/symfony-application)

Use this project if you want to quickly set up a basis for your web application. This application
is built on [`endroid/symfony-standard`](https://github.com/symfony/symfony-standard) and extended
with popular and well-maintained community bundles and some example implementations to speed up the
development process. You decide which functionalities you use, depending on the type of web
application you are building. Browse the [`live demo`](http://symfony-application.endroid.nl/) and
the [`admin section`](http://symfony-application.endroid.nl/admin/dashboard) (admin/admin)
to get a quick impression of the full package.

## Live demo

  * Front end - [`symfony-application.endroid.nl`](http://symfony-application.endroid.nl/)
  * Admin - [`symfony-application.endroid.nl/admin/dashboard`](http://symfony-application.endroid.nl/admin/dashboard) (admin/admin)

## Features

  * Base layout
    * Twitter Bootstrap 3
    * Multilanguage support
  * Admin
    * User management
    * Google OpenID login
    * Multilanguage support
    * Admins: menus, pages, news, media, forms
  * Behaviors
    * Publishable
    * Sluggable
    * Sortable
    * Timestampable
    * Translatable
    * Traversable
  * Search engine
    * ElasticSearch
  * Demo functionality
    * Pages, news, contact form
  * Sitemap HTML and XML

## Installation

### Create the project

    composer create-project endroid/symfony-application <target>

### Create the database and schema

    php app/console doctrine:database:create
    php app/console doctrine:schema:update --force

### Install ElasticSearch (optional)

See http://www.elasticsearch.org/guide/reference/setup/installation/ for more information.

### Load fixtures (optional)

    php app/console doctrine:fixtures:load -n
    php app/console assets:install --symlink
    php app/console fos:elastica:populate

## Note

Please note that if you are using PHP < 5.4 and you want to make use of the provided behaviors
you will have to copy the trait code into your entities instead of using the traits.

## Documentation

The documentation is stored in the `src/Endroid/Bundle/SiteBundle/Resources/doc/index.md` file in this bundle.
[Read the Documentation](https://github.com/endroid/symfony-application/tree/master/src/Endroid/Bundle/SiteBundle/Resources/doc/index.md)
