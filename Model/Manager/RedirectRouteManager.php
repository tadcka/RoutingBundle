<?php

/*
 * This file is part of the Evispa package.
 *
 * (c) Evispa <info@evispa.lt>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle\Model\Manager;

/**
 * @author Tadas Gliaubicas <tadas@evispa.lt>
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
 