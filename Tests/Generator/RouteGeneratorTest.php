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
use Tadcka\Bundle\RoutingBundle\Tests\Mock\Model\MockRoute;

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

    /**
     * @expectedException \Tadcka\Bundle\RoutingBundle\Exception\RoutingRuntimeException
     */
    public function testGenerateUniqueRouteException()
    {
        $routeManager = new MockRouteManager();
        $generator = new RouteGenerator($routeManager);

        $mockRoute = new MockRoute();
        $mockRoute->setRoutePattern($generator->generateRouteFromText('Kiškis ėjo takeliu ir sutiko mešką'));
        $generator->generateUniqueRoute($mockRoute);
    }

    public function testGenerateUniqueRoute()
    {
        $routeManager = new MockRouteManager();
        $generator = new RouteGenerator($routeManager);

        $mockRoute = new MockRoute();
        $mockRoute->setName('test');
        $mockRoute->setRoutePattern($generator->generateRouteFromText('Kiškis ėjo takeliu ir sutiko mešką'));
        $this->assertEquals(
            '/kiskis-ejo-takeliu-ir-sutiko-meska',
            $generator->generateUniqueRoute($mockRoute)->getRoutePattern()
        );

        $route = $routeManager->create();
        $route->setRoutePattern('kiskis-ejo-takeliu-ir-sutiko-meska');
        $routeManager->add($route);
        $mockRoute->setRoutePattern($generator->generateRouteFromText('Kiškis ėjo takeliu ir sutiko mešką/.'));

        $this->assertEquals(
            '/kiskis-ejo-takeliu-ir-sutiko-meska-1',
            $generator->generateUniqueRoute($mockRoute)->getRoutePattern()
        );

        $route = $routeManager->create();
        $route->setRoutePattern('kiskis-ejo-takeliu-ir-sutiko-meska-1');
        $routeManager->add($route);
        $mockRoute->setRoutePattern($generator->generateRouteFromText('Kiškis ėjo takeliu ir sutiko mešką/.'));

        $this->assertEquals(
            '/kiskis-ejo-takeliu-ir-sutiko-meska-2',
            $generator->generateUniqueRoute($mockRoute)->getRoutePattern()
        );
    }
}
