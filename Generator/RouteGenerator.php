<?php

/*
 * This file is part of the Evispa package.
 *
 * (c) Evispa <info@evispa.lt>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle\Generator;

use Ferrandini\Urlizer;
use Tadcka\Bundle\RoutingBundle\Model\Manager\RouteManagerInterface;

/**
 * @author Tadas Gliaubicas <tadas@evispa.lt>
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
     * Generate unique route from text.
     *
     * @param string $text
     *
     * @return null|string
     */
    public function generateUniqueRouteFromText($text)
    {
        $originalRoute = $this->generateRouteFromText($text);

        if ($originalRoute) {
            $key = 0;
            $route = $this->normalizeRoute($originalRoute);

            while ($this->hasRoute($route)) {
                $key++;
                $route = $originalRoute . '-' . $key;
            }

            return $route;
        }

        return null;
    }

    /**
     * Has route.
     *
     * @param string $route
     *
     * @return bool
     */
    private function hasRoute($route)
    {
        return (null !== $this->routeManager->findByRoutePattern($route));
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
