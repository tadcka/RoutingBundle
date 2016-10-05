<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle\Form\Exception;

use InvalidArgumentException as BaseInvalidArgumentException;

/**
 * Class InvalidArgumentException.
 * 
 * @package Tadcka\Bundle\RoutingBundle\Form\Exception
 */
class InvalidArgumentException extends BaseInvalidArgumentException
{
    /**
     * @param string $class
     * 
     * @return InvalidArgumentException
     */
    public static function create($class)
    {
        return new self(sprintf('Form type with class "%s" can not be found. Please check for typos or add it to the map in LegacyFormHelper', $class));
    }
}
