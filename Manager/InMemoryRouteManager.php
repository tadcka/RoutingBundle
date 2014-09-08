<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle\Manager;

use Tadcka\Bundle\RoutingBundle\Exception\RoutingRuntimeException;
use Tadcka\Bundle\RoutingBundle\Model\Manager\RouteManager;
use Tadcka\Bundle\RoutingBundle\Model\Manager\RouteManagerInterface;
use Tadcka\Bundle\RoutingBundle\Model\RouteInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 9/1/14 8:30 PM
 */
class InMemoryRouteManager extends RouteManager
{
    /**
     * @var RouteManagerInterface
     */
    private $routeManager;

    /**
     * @var array|RouteInterface[]
     */
    private $routes = array();

    /**
     * Constructor.
     *
     * @param RouteManagerInterface $routeManager
     */
    public function __construct(RouteManagerInterface $routeManager)
    {
        $this->routeManager = $routeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function findByName($name)
    {
        if (isset($this->routes[$name])) {
            return $this->routes[$name];
        }

        return $this->routeManager->findByName($name);
    }

    /**
     * {@inheritdoc}
     */
    public function findByNames(array $names)
    {
        $names = array_diff($names, array_keys($this->routes));

        return array_merge(array_values($this->routes), $this->routeManager->findByNames($names));
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

        return $this->routeManager->findByRoutePattern($routePattern);
    }

    /**
     * {@inheritdoc}
     */
    public function findByRoutePatterns(array $routePatterns)
    {
        $result = array();
        foreach ($routePatterns as $routePattern) {
            foreach ($this->routes as $route) {
                if ($routePattern === $route->getRoutePattern()) {
                    $result[$routePattern] = $route;
                }
            }
        }

        $routePatterns = array_diff($routePatterns, array_keys($result));

        return array_merge(array_values($result), $this->routeManager->findByRoutePatterns($routePatterns));
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        $routes = $this->routes;
        foreach ($this->routeManager->all() as $route) {
            if (false === isset($routes[$route->getName()])) {
                $routes[$route->getName()] = $route;
            }
        }

        return array_values($routes);
    }

    /**
     * {@inheritdoc}
     */
    public function add(RouteInterface $route, $save = false)
    {
        if (!$route->getName()) {
            throw new RoutingRuntimeException('Route name is empty!');
        }

        $this->routes[$route->getName()] = $route;
        $this->routeManager->add($route, $save);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(RouteInterface $route, $save = false)
    {
        if (isset($this->routes[$route->getName()])) {
            unset($this->routes[$route->getName()]);
        }
        $this->routeManager->remove($route, $save);
    }

    /**
     * {@inheritdoc}
     */
    public function save()
    {
        $this->routeManager->save();
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->routeManager->clear();
    }

    /**
     * {@inheritdoc}
     */
    public function getClass()
    {
        return $this->routeManager->getClass();
    }
}
