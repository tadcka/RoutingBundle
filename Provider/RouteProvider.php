<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle\Provider;

use Symfony\Cmf\Component\Routing\Candidates\CandidatesInterface;
use Symfony\Cmf\Component\Routing\RouteProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\RouteCollection;
use Tadcka\Bundle\RoutingBundle\Model\Manager\RouteManagerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 7/1/14 10:36 PM
 */
class RouteProvider implements RouteProviderInterface
{
    /**
     * @var RouteManagerInterface
     */
    private $routeManager;

    /**
     * @var CandidatesInterface
     */
    private $candidatesStrategy;

    /**
     * Constructor.
     *
     * @param RouteManagerInterface $routeManager
     * @param CandidatesInterface $candidatesStrategy
     */
    public function __construct(RouteManagerInterface $routeManager, CandidatesInterface $candidatesStrategy)
    {
        $this->routeManager = $routeManager;
        $this->candidatesStrategy = $candidatesStrategy;
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteCollectionForRequest(Request $request)
    {
        $collection = new RouteCollection();

        $candidates = $this->candidatesStrategy->getCandidates($request);

        if (0 === count($candidates)) {
            return $collection;
        }

        $routes = $this->routeManager->findByRoutePatterns($candidates);
        foreach ($routes as $route) {
            $collection->add($route->getName(), $route);
        }

        return $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteByName($name)
    {
        $route = $this->routeManager->findByName($name);

        if (null === $route) {
            throw new RouteNotFoundException("No route found for path '$name'");
        }

        return $route;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoutesByNames($names)
    {
        if (null !== $names && is_array($names)) {
            return $this->routeManager->findByNames($names);
        }

        return array();
    }
}
