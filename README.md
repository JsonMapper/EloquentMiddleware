![Logo](https://jsonmapper.net/images/jsonmapper.png)

---
**This is a Laravel package for using JsonMapper in you Laravel application.** 

JsonMapper is a PHP library that allows you to map a JSON response to your PHP objects that are either annotated using doc blocks or use typed properties.
For more information see the project website: https://jsonmapper.net

![GitHub](https://img.shields.io/github/license/JsonMapper/EloquentMiddleware)
![Packagist Version](https://img.shields.io/packagist/v/json-mapper/eloquent-middleware)
![PHP from Packagist](https://img.shields.io/packagist/php-v/json-mapper/eloquent-middleware)
[![Build Status](https://api.travis-ci.com/JsonMapper/EloquentMiddleware.svg?branch=master)](https://travis-ci.com/JsonMapper/EloquentMiddleware) 
[![Coverage Status](https://coveralls.io/repos/github/JsonMapper/EloquentMiddleware/badge.svg?branch=master)](https://coveralls.io/github/JsonMapper/EloquentMiddleware?branch=master)

# Why use JsonMapper
Continuously mapping your JSON responses to your own objects becomes tedious and is error prone. Not mentioning the
tests that needs to be written for said mapping.

JsonMapper has been build with the most common usages in mind. In order to allow for those edge cases which are not 
supported by default, it can easily be extended as its core has been designed using middleware.

JsonMapper supports the following features
 * Case conversion
 * Debugging
 * DocBlock annotations
 * Final callback
 * Namespace resolving
 * PHP 7.4 Types properties
  
# Installing JsonMapper Eloquent Middleware 
The installation of JsonMapper Eloquent Middleware can easily be done with [Composer](https://getcomposer.org)
```bash
$ composer require json-mapper/eloquent-middleware
```
The example shown above assumes that `composer` is on your `$PATH`.

# Contributing
Please refer to [CONTRIBUTING.md](https://github.com/JsonMapper/EloquentMiddleware/blob/master/CONTRIBUTING.md) for information on how to contribute to JsonMapper Eloquent Middleware.

## List of Contributors
Thanks to everyone who has contributed to JsonMapper Eloquent Middleware! You can find a detailed list of contributors of JsonMapper on [GitHub](https://github.com/JsonMapper/EloquentMiddleware/graphs/contributors).

# License
The MIT License (MIT). Please see [License File](https://github.com/JsonMapper/EloquentMiddleware/blob/master/LICENSE) for more information.
