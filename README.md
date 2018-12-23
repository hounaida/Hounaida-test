Description
========

The purpose of the app is to load products and its reviews from an external json resource and display a table product. 
Both Unit and Functional testing are implemented in this app. 

### Setup the project

```
$ cd /var/www/html
$ git clone git@github.com:hounaida/Hounaida-test.git hounaida-app
$ cd hounaida-app
$ composer install
```

### Load fixtures

In order to load the sample data, run the below commands:

```
$ cd /var/www/html/hounaida-app
$ php bin/console doctrine:fixtures:load
```