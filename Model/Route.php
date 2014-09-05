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
     * @var string
     */
    protected $prefix;

    /**
     * Whether this route was changed since being last compiled.
     *
     * State information not persisted in storage.
     *
     * @var bool
     */
    protected $recompile = false;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct($this->routePattern);
        $this->setDefaults(array());
    }

    /**
     * {@inheritdoc}
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
        $this->routePattern = '/' . ltrim(trim($routePattern), '/');
        $this->setPath($this->routePattern);
        $this->recompile = true;

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
     * @deprecated
     */
    public function getPattern()
    {
        return $this->getPath();
    }

    /**
     * {@inheritDoc}
     */
    public function getPath()
    {
        return $this->prefix . $this->getRoutePattern();
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

    /**
     * {@inheritdoc}
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Add locale.
     *
     * @param $defaultLocale
     * @param array $localeRequirements
     */
    public function addLocale($defaultLocale, array $localeRequirements)
    {
        $this->prefix = '/{_locale}';
        $this->setDefault('_locale', $defaultLocale);
        $this->addRequirements(array('_locale' => implode('|', $localeRequirements)));
    }

    /**
     * {@inheritDoc}
     */
    public function compile()
    {
        if ($this->recompile) {
            parent::setPath($this->getPath());
        }

        return parent::compile();
    }
}
