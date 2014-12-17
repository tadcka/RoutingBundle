RoutingBundle
=============

[![Build Status](https://scrutinizer-ci.com/g/tadcka/RoutingBundle/badges/build.png?b=master)](https://scrutinizer-ci.com/g/tadcka/RoutingBundle/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/tadcka/RoutingBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/tadcka/RoutingBundle/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/tadcka/routing-bundle/v/stable.svg)](https://packagist.org/packages/tadcka/routing-bundle) [![Total Downloads](https://poser.pugx.org/tadcka/routing-bundle/downloads.svg)](https://packagist.org/packages/tadcka/routing-bundle) [![Latest Unstable Version](https://poser.pugx.org/tadcka/routing-bundle/v/unstable.svg)](https://packagist.org/packages/tadcka/routing-bundle) [![License](https://poser.pugx.org/tadcka/routing-bundle/license.svg)](https://packagist.org/packages/tadcka/routing-bundle)

Routing bundle integrating cmf routing component.

## Installation

### Step 1: Download RoutingBundle using composer

Add RoutingBundle in your composer.json:

```js
{
    "require": {
        "tadcka/routing-bundle": "dev-master"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update tadcka/routing-bundle
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Tadcka\RoutingBundle\TadckaRoutingBundle(),
    );
}
```

[1. Configure the TadckaRoutingBundle](https://github.com/tadcka/RoutingBundle/blob/master/Resources/doc/Config.md)

[2. Doctrine ORM Route class](https://github.com/tadcka/RoutingBundle/blob/master/Resources/doc/ORM.md)

License
-------

This bundle is under the MIT license. See the complete license in the bundle:

Code License:
[Resources/meta/LICENSE](https://github.com/tadcka/RoutingBundle/blob/master/Resources/meta/LICENSE)

