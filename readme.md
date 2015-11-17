## Identity service client

PHP client for the Product service

### Requirements

* PHP 5.4


### Installation

Since the package is not published on Packagist and is hosted on a private repository, you will need to have the SSH keys for accessing the repository.

Install via composer - edit your `composer.json` to require the package.

    {
       "require": {
           "JSainsburyPLC/php-products-client": "dev-master"
       },
       
       "repositories": [
           {
               "type": "vcs",
               "url":  "git@github.com:JSainsburyPLC/php-products-client.git"
           }
       ]
    }
    
Then run `composer update` in your terminal to pull it in.
    
The package can be used as standalone, but there's also a Laravel\Lumen service provider


### Laravel & Lumen

You will need to add the service provider to the providers array in your `app.php` config as follows:

    'JS\Services\Products\ProductsServiceProvider'
    
and pusblish the configuration file

```sh
$ php artisan vendor:publish
```