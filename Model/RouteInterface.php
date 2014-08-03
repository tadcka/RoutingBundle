<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle\Model;

use Symfony\Cmf\Component\Routing\RouteObjectInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 7/1/14 11:00 PM
 */
interface RouteInterface extends RouteObjectInterface
{
    /**
     * Get id.
     *
     * @return int
     */
    public function getId();

    /**
     * Get name.
     *
     * @param string $name
     *
     * @return RouteInterface
     */
    public function setName($name);

    /**
     * Get name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set routePattern.
     *
     * @param string $routePattern
     *
     * @return RouteInterface
     */
    public function setRoutePattern($routePattern);

    /**
     * Get routePattern.
     *
     * @return string
     */
    public function getRoutePattern();

    /**
     * Sets a default value.
     *
     * @param string $name    A variable name
     * @param mixed  $default The default value
     *
     * @return Route The current Route instance
     */
    public function setDefault($name, $default);
}
