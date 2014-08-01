<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle\Tests\Generator;

use Tadcka\Bundle\RoutingBundle\Generator\RouteGenerator;
use Tadcka\Bundle\RoutingBundle\Tests\Mock\Model\Manager\MockRouteManager;

class RouteGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerateRouteFromText()
    {
        $generator = new RouteGenerator(new MockRouteManager());

        $this->assertEquals(
            '/kiskis-ejo-takeliu-ir-sutiko-meska',
            $generator->generateRouteFromText('Kiškis ėjo takeliu ir sutiko mešką')
        );

        $this->assertEquals(
            '/aceeisuuz',
            $generator->generateRouteFromText('  ĄčĘėĮšŲūŽ  ')
        );

        $this->assertEquals(
            '/aceei-suuz',
            $generator->generateRouteFromText('  ĄčĘėĮ                                               šŲūŽ  ')
        );

        $this->assertEquals(
            '/a-ceei-su-uz',
            $generator->generateRouteFromText('  Ą..čĘėĮ/šŲ..ūŽ/  ')
        );
    }

    public function testGenerateUniqueRouteFromText()
    {
        $routeManager = new MockRouteManager();
        $generator = new RouteGenerator($routeManager);

        $this->assertEquals(
            '/kiskis-ejo-takeliu-ir-sutiko-meska',
            $generator->generateUniqueRouteFromText('Kiškis ėjo takeliu ir sutiko mešką')
        );

        $route = $routeManager->create();
        $route->setRoutePattern('kiskis-ejo-takeliu-ir-sutiko-meska');
        $routeManager->add($route);

        $this->assertEquals(
            '/kiskis-ejo-takeliu-ir-sutiko-meska-1',
            $generator->generateUniqueRouteFromText('Kiškis ėjo takeliu ir sutiko mešką/.')
        );

        $route = $routeManager->create();
        $route->setRoutePattern('kiskis-ejo-takeliu-ir-sutiko-meska-1');
        $routeManager->add($route);

        $this->assertEquals(
            '/kiskis-ejo-takeliu-ir-sutiko-meska-2',
            $generator->generateUniqueRouteFromText('Kiškis ėjo takeliu ir sutiko mešką/.')
        );
    }
}
