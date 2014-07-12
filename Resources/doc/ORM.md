## Doctrine ORM Route class

``` php
<?php
// src/Tadcka/Bundle/AcmeBundle/Entity/Route.php

namespace Tadcka\Bundle\AcmeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Tadcka\Bundle\RoutingBundle\Model\Route as BaseRoute;

/**
 * @ORM\Entity
 * @ORM\Table(name="tadcka_route")
 */
class Route extends BaseRoute
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }
}
```

