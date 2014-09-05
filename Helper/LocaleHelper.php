<?php

/*
 * This file is part of the Evispa package.
 *
 * (c) Evispa <info@evispa.lt>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle\Helper;

/**
 * @author Tadas Gliaubicas <tadas@evispa.lt>
 *
 * @since 9/5/14 10:12 AM
 */
class LocaleHelper
{
    /**
     * @var string
     */
    private $defaultLocale;

    /**
     * @var array
     */
    private $locales;

    /**
     * Constructor.
     *
     * @param string $defaultLocale
     * @param array $locales
     */
    public function __construct($defaultLocale, array $locales)
    {
        $this->defaultLocale = $defaultLocale;
        $this->locales = $locales;
    }

    /**
     * Get default locale.
     *
     * @return string
     */
    public function getDefaultLocale()
    {
        return $this->defaultLocale;
    }

    /**
     * Get locales.
     *
     * @return array
     */
    public function getLocales()
    {
        return $this->locales;
    }

    /**
     * Get locale prefix.
     *
     * @return string
     */
    public function getLocalePrefix()
    {
        return '/{_locale}';
    }
}
