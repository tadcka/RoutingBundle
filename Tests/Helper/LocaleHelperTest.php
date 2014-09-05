<?php

/*
 * This file is part of the Evispa package.
 *
 * (c) Evispa <info@evispa.lt>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle\Tests\Helper;

use Tadcka\Bundle\RoutingBundle\Helper\LocaleHelper;

/**
 * @author Tadas Gliaubicas <tadas@evispa.lt>
 *
 * @since 9/5/14 10:20 AM
 */
class LocaleHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LocaleHelper
     */
    private $localeHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->localeHelper = new LocaleHelper('en', array('en', 'lt'));
    }

    public function testGetDefaultLocale()
    {
        $this->assertEquals('en', $this->localeHelper->getDefaultLocale());
    }

    public function testGetLocales()
    {
        $this->assertEquals(array('en', 'lt'), $this->localeHelper->getLocales());
    }

    public function testGetLocalePrefix()
    {
        $this->assertEquals('/{_locale}', $this->localeHelper->getLocalePrefix());
    }
}
