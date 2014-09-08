<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle\Model;

use Symfony\Cmf\Component\Routing\RedirectRouteInterface as BaseRedirectRouteInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 8/28/14 2:17 PM
 */
interface RedirectRouteInterface extends BaseRedirectRouteInterface
{
    /**
     * Set absolute uri to redirect to.
     *
     * @param string $uri
     *
     * @return RedirectRouteInterface
     */
    public function setUri($uri);

    /**
     * Set target route.
     *
     * @param RouteInterface $routeTarget
     *
     * @return RedirectRouteInterface
     */
    public function setRouteTarget(RouteInterface $routeTarget);

    /**
     * Get the target route document this route redirects to.
     *
     * If non-null, it is added as route into the parameters, which will lead
     * to have the generate call issued by the RedirectController to have
     * the target route in the parameters.
     *
     * @return RouteInterface
     */
    public function getRouteTarget();

    /**
     * Set route name.
     *
     * @param string $routeName
     *
     * @return RedirectRouteInterface
     */
    public function setRouteName($routeName);

    /**
     * Set permanent.
     *
     * @param bool $permanent
     *
     * @return RedirectRouteInterface
     */
    public function setPermanent($permanent);

    /**
     * Set route parameters.
     *
     * @param array $parameters
     *
     * @return RedirectRouteInterface
     */
    public function setParameters(array $parameters);
}
