<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle\Model\Manager;

use Tadcka\Bundle\RoutingBundle\Model\RouteInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 7/1/14 10:58 PM
 */
interface RouteManagerInterface
{
    /**
     * Find by name.
     *
     * @param string $name
     *
     * @return null|RouteInterface
     */
    public function findByName($name);

    /**
     * Find by many names.
     *
     * @param array $names
     *
     * @return array|RouteInterface[]
     */
    public function findByNames(array $names);

    /**
     * Find by route pattern.
     *
     * @param string $routePattern
     *
     * @return RouteInterface
     */
    public function findByRoutePattern($routePattern);

    /**
     * Find by many route patterns.
     *
     * @param array $routePatterns
     *
     * @return array|RouteInterface[]
     */
    public function findByRoutePatterns(array $routePatterns);

    /**
     * Get all routes.
     *
     * @return array|RouteInterface[]
     */
    public function all();

    /**
     * Create new route.
     *
     * @return RouteInterface
     */
    public function create();

    /**
     * Add route to persistent layer.
     *
     * @param RouteInterface $route
     * @param bool $save
     */
    public function add(RouteInterface $route, $save = false);

    /**
     * Remove route from persistent layer.
     *
     * @param RouteInterface $route
     * @param bool $save
     */
    public function remove(RouteInterface $route, $save = false);

    /**
     * Save persistent layer.
     */
    public function save();

    /**
     * Clear route objects from persistent layer.
     */
    public function clear();

    /**
     * Get route class name.
     *
     * @return string
     */
    public function getClass();
}
