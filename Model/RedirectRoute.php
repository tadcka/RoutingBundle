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

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 7/1/14 10:54 PM
 */
abstract class RedirectRoute extends Route implements RedirectRouteInterface
{
    /**
     * Absolute uri to redirect to.
     *
     * @var string
     */
    protected $uri;

    /**
     * The name of a target route (for use with standard symfony routes).
     *
     * @var string
     */
    protected $routeName;

    /**
     * Target route to redirect to different dynamic route.
     *
     * @var RouteInterface
     */
    protected $routeTarget;

    /**
     * Whether this is a permanent redirect. Defaults to true.
     *
     * @var bool
     */
    protected $permanent = true;

    /**
     * Route parameters.
     *
     * @var array
     */
    protected $parameters = array();

    /**
     * {@inheritdoc}
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * {@inheritdoc}
     */
    public function setRouteTarget(RouteInterface $routeTarget)
    {
        $this->routeTarget = $routeTarget;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteTarget()
    {
        return $this->routeTarget;
    }

    /**
     * {@inheritdoc}
     */
    public function setRouteName($routeName)
    {
        $this->routeName = $routeName;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteName()
    {
        return $this->routeName;
    }

    /**
     * {@inheritdoc}
     */
    public function setPermanent($permanent)
    {
        $this->permanent = $permanent;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isPermanent()
    {
        return $this->permanent;
    }

    /**
     * {@inheritdoc}
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }
}
