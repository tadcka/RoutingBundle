<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle\Tests\Mock\Model\Manager;

use Tadcka\Bundle\RoutingBundle\Model\Manager\RouteManager as BaseRouteManager;
use Tadcka\Bundle\RoutingBundle\Model\RouteInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 8/1/14 11:11 AM
 */
class MockRouteManager extends BaseRouteManager
{
    /**
     * @var array|RouteInterface[]
     */
    private $routes = array();

    /**
     * {@inheritdoc}
     */
    public function findByName($name)
    {
        // TODO: Implement findByName() method.
    }

    /**
     * {@inheritdoc}
     */
    public function findByNames(array $names)
    {
        // TODO: Implement findByNames() method.
    }

    /**
     * {@inheritdoc}
     */
    public function findByRoutePattern($routePattern)
    {
        foreach ($this->routes as $route) {
            if ($routePattern === $route->getRoutePattern()) {
                return $route;
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function findByRoutePatterns(array $routePatterns)
    {
        // TODO: Implement findByRoutePatterns() method.
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        // TODO: Implement all() method.
    }

    /**
     * {@inheritdoc}
     */
    public function add(RouteInterface $route, $save = false)
    {
        $this->routes[] = $route;
    }

    /**
     * {@inheritdoc}
     */
    public function remove(RouteInterface $route, $save = false)
    {
        // TODO: Implement delete() method.
    }

    /**
     * {@inheritdoc}
     */
    public function save()
    {
        // TODO: Implement save() method.
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        // TODO: Implement clear() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getClass()
    {
        return 'Tadcka\Bundle\RoutingBundle\Tests\Mock\Model\MockRoute';
    }
}
