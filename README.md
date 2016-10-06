# Doctrine UK Postcode Type
Doctrine UK Postcode Type

[![Build Status](https://travis-ci.org/vasildakov/postcode-doctrine.svg?branch=master)](https://travis-ci.org/vasildakov/postcode-doctrine)
[![Coverage Status](https://coveralls.io/repos/github/vasildakov/postcode-doctrine/badge.svg?branch=master)](https://coveralls.io/github/vasildakov/postcode-doctrine?branch=master)
[![HHVM Status](http://hhvm.h4cc.de/badge/vasildakov/postcode-doctrine.svg?style=flat)](http://hhvm.h4cc.de/package/vasildakov/postcode-doctrine)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/vasildakov/postcode-doctrine/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/vasildakov/postcode-doctrine/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/vasildakov/postcode-doctrine/v/stable)](https://packagist.org/packages/vasildakov/postcode-doctrine)
[![Total Downloads](https://poser.pugx.org/vasildakov/postcode-doctrine/downloads)](https://packagist.org/packages/vasildakov/postcode-doctrine)
[![License](https://poser.pugx.org/vasildakov/postcode-doctrine/license)](https://packagist.org/packages/vasildakov/postcode-doctrine)


## Installation

The preferred method of installation is via [Packagist][] and [Composer][]. Run
the following command to install the package and add it as a requirement to
your project's `composer.json`:

```bash
composer require vasildakov/postcode-doctrine
```


## Configuration

To configure Doctrine to use vasildakov/postcode as a field type, you'll need to set up
the following in your bootstrap:

``` php
\Doctrine\DBAL\Types\Type::addType('postcode', 'VasilDakov\Postcode\Doctrine\PostcodeType');
```

Then, in your models, you may annotate properties by setting the `@Column`
type to `postcode`.

``` php
/**
 * @Entity
 * @Table(name="address")
 */
class Address
{
    /**
     * @var \VasilDakov\Postcode\Postcode
     * @Column(type="postcode")
     */
    protected $postcode;

    public function getPostcode()
    {
        return $this->postcode;
    }
}
```

## Copyright and License

The vasildakov/postcode-doctrine library is copyright © [Vasil Dakov](http://vasildakov.com/) and
licensed for use under the MIT License (MIT). Please see [LICENSE][] for more
information.


[packagist]: https://packagist.org/packages/vasildakov/postcode-doctrine
[composer]: http://getcomposer.org/