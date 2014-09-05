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

use Symfony\Cmf\Component\Routing\RouteObjectInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 7/1/14 11:00 PM
 */
interface RouteInterface extends RouteObjectInterface
{
    /**
     * Get id.
     *
     * @return int
     */
    public function getId();

    /**
     * Get name.
     *
     * @param string $name
     *
     * @return RouteInterface
     */
    public function setName($name);

    /**
     * Get name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set routePattern.
     *
     * @param string $routePattern
     *
     * @return RouteInterface
     */
    public function setRoutePattern($routePattern);

    /**
     * Get routePattern.
     *
     * @return string
     */
    public function getRoutePattern();

    /**
     * Set prefix.
     *
     * @param string $prefix
     *
     * @return RouteInterface
     */
    public function setPrefix($prefix);

    /**
     * Get prefix.
     *
     * @return string
     */
    public function getPrefix();

    /**
     * Returns the pattern for the path.
     *
     * @return string The path pattern
     */
    public function getPath();

    /**
     * Sets the pattern for the path.
     *
     * This method implements a fluent interface.
     *
     * @param string $pattern The path pattern
     *
     * @return Route The current Route instance
     */
    public function setPath($pattern);

    /**
     * Sets a default value.
     *
     * @param string $name    A variable name
     * @param mixed  $default The default value
     *
     * @return Route The current Route instance
     */
    public function setDefault($name, $default);

    /**
     * Returns the defaults.
     *
     * @return array The defaults
     */
    public function getDefaults();

    /**
     * Returns the requirements.
     *
     * @return array The requirements
     */
    public function getRequirements();

    /**
     * Sets the requirements.
     *
     * This method implements a fluent interface.
     *
     * @param array $requirements The requirements
     *
     * @return Route The current Route instance
     */
    public function setRequirements(array $requirements);

    /**
     * Adds requirements.
     *
     * This method implements a fluent interface.
     *
     * @param array $requirements The requirements
     *
     * @return Route The current Route instance
     */
    public function addRequirements(array $requirements);

    /**
     * Returns the requirement for the given key.
     *
     * @param string $key The key
     *
     * @return string|null The regex or null when not given
     */
    public function getRequirement($key);

    /**
     * Checks if a requirement is set for the given key.
     *
     * @param string $key A variable name
     *
     * @return bool    true if a requirement is specified, false otherwise
     */
    public function hasRequirement($key);

    /**
     * Sets a requirement for the given key.
     *
     * @param string $key   The key
     * @param string $regex The regex
     *
     * @return Route The current Route instance
     */
    public function setRequirement($key, $regex);

    /**
     * Add locale.
     *
     * @param $defaultLocale
     * @param array $localeRequirements
     */
    public function addLocale($defaultLocale, array $localeRequirements);
}
