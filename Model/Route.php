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

use Symfony\Component\Routing\Route as SymfonyRoute;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 7/1/14 10:54 PM
 */
abstract class Route extends SymfonyRoute implements RouteInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $routePattern;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct($this->routePattern);
        $this->setDefaults(array());
    }

    /**
     * Get the content document this route entry stands for. If non-null,
     * the ControllerClassMapper uses it to identify a controller and
     * the content is passed to the controller.
     *
     * If there is no specific content for this url (i.e. its an "application"
     * page), may return null.
     *
     * @return object the document or entity this route entry points to
     */
    public function getContent()
    {
        // TODO: Implement getContent() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteKey()
    {
        return $this->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function setRoutePattern($routePattern)
    {
        $this->routePattern = '/'.ltrim(trim($routePattern), '/');
        $this->setPath($this->routePattern);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getRoutePattern()
    {
        return $this->routePattern;
    }

    /**
     * {@inheritDoc}
     */
    public function getPath()
    {
        return $this->routePattern;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }
}
