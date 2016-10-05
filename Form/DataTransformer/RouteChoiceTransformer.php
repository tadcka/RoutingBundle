<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TTadcka\Bundle\RoutingBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Tadcka\Component\Routing\Model\Manager\RouteManagerInterface;
use Tadcka\Component\Routing\Model\RouteInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 11/4/14 10:54 PM
 */
class RouteChoiceTransformer implements DataTransformerInterface
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
     * Transform.
     *
     * @param null|RouteInterface $route
     *
     * @return null|string
     */
    public function transform($route)
    {
        if (null !== $route) {
            return $route->getName();
        }

        return null;
    }

    /**
     * Reverse transform.
     *
     * @param null|string $routeName
     *
     * @return null|RouteInterface
     */
    public function reverseTransform($routeName)
    {
        if (null !== $routeName) {
            return $this->routeManager->findByName($routeName);
        }

        return null;
    }
}
