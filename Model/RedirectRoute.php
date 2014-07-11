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

use Symfony\Cmf\Component\Routing\RedirectRouteInterface;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 7/1/14 10:54 PM
 */
class RedirectRoute extends Route implements RedirectRouteInterface
{
    /**
     * Get the absolute uri to redirect to external domains.
     *
     * If this is non-empty, the other methods won't be used.
     *
     * @return string target absolute uri
     */
    public function getUri()
    {
        // TODO: Implement getUri() method.
    }

    /**
     * Get the target route document this route redirects to.
     *
     * If non-null, it is added as route into the parameters, which will lead
     * to have the generate call issued by the RedirectController to have
     * the target route in the parameters.
     *
     * @return RouteObjectInterface the route this redirection points to
     */
    public function getRouteTarget()
    {
        // TODO: Implement getRouteTarget() method.
    }

    /**
     * Get the name of the target route for working with the symfony standard
     * router.
     *
     * @return string target route name
     */
    public function getRouteName()
    {
        // TODO: Implement getRouteName() method.
    }

    /**
     * Whether this should be a permanent or temporary redirect
     *
     * @return boolean
     */
    public function isPermanent()
    {
        // TODO: Implement isPermanent() method.
    }

    /**
     * Get the parameters for the target route router::generate()
     *
     * Note that for the DynamicRouter, you return the target route
     * document as field 'route' of the hashmap.
     *
     * @return array Information to build the route
     */
    public function getParameters()
    {
        // TODO: Implement getParameters() method.
    }
}
