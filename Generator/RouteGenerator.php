<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle\Generator;

use Ferrandini\Urlizer;
use Tadcka\Bundle\RoutingBundle\Exception\RoutingRuntimeException;
use Tadcka\Bundle\RoutingBundle\Model\Manager\RouteManagerInterface;
use Tadcka\Bundle\RoutingBundle\Model\RouteInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 8/1/14 10:57 AM
 */
class RouteGenerator
{
    /**
     * @var RouteManagerInterface
     */
    private $routeManager;

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
     * Generate route from text.
     *
     * @param string $text
     *
     * @return string
     */
    public function generateRouteFromText($text)
    {
        return $this->normalizeRoute(Urlizer::urlize($text));
    }

    /**
     * Generate unique route.
     *
     * @param RouteInterface $route
     *
     * @return null|RouteInterface
     */
    public function generateUniqueRoute(RouteInterface $route)
    {
        $originalRoutePattern = $this->generateRouteFromText($route->getRoutePattern());

        if ($originalRoutePattern) {
            $key = 0;
            $routePattern = $this->normalizeRoute($originalRoutePattern);

            while ($this->hasRoute($routePattern, $route->getName())) {
                $key++;
                $routePattern = $originalRoutePattern . '-' . $key;
            }

            $route->setRoutePattern($routePattern);

            return $route;
        }

        return null;
    }

    /**
     * Has route.
     *
     * @param string $routePattern
     * @param string $routeName
     *
     * @return bool
     *
     * @throws RoutingRuntimeException
     */
    private function hasRoute($routePattern, $routeName)
    {
        if (!$routeName) {
            throw new RoutingRuntimeException('Route name is empty!');
        }

        $route = $this->routeManager->findByRoutePattern($routePattern);

        return ((null !== $route) && ($routeName !== $route->getName()));
    }

    /**
     * Normalize route.
     *
     * @param string $route
     *
     * @return string
     */
    private function normalizeRoute($route)
    {
        return '/'.ltrim(trim($route), '/');
    }
}
