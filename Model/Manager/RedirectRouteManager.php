<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle\Model\Manager;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 8/28/14 2:26 PM
 */
abstract class RedirectRouteManager implements RedirectRouteManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function create()
    {
        $className = $this->getClass();
        $redirectObject = new $className;

        return $redirectObject;
    }
}
 