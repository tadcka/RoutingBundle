<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle\Form\Util;

use Tadcka\Bundle\RoutingBundle\Form\Exception\InvalidArgumentException;

/**
 * Class LegacyFormHelper.
 * 
 * @package Tadcka\Bundle\RoutingBundle\Form\Util
 */
class LegacyFormHelper
{
    private static $map = [
        'Tadcka\Bundle\RoutingBundle\Form\Type\RouteChoiceType' => 'tadcka_route_choice',
        'Symfony\Component\Form\Extension\Core\Type\CheckboxType' => 'checkbox',
        'Symfony\Component\Form\Extension\Core\Type\ChoiceType' => 'choice',
        'Symfony\Component\Form\Extension\Core\Type\TextType' => 'text',
    ];

    /**
     * @param string $class
     *
     * @return string
     *
     * @throws InvalidArgumentException
     */
    public static function getType($class)
    {
        if (false === self::isLegacy()) {
            return $class;
        }

        if (false === isset(self::$map[$class])) {
            throw InvalidArgumentException::create($class);
        }

        return self::$map[$class];
    }

    /**
     * @return bool
     */
    public static function isLegacy()
    {
        return !method_exists('Symfony\Component\Form\AbstractType', 'getBlockPrefix');
    }
}
