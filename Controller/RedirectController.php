<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle\Controller;

use Symfony\Cmf\Component\Routing\RedirectRouteInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 8/28/14 12:23 PM
 */
class RedirectController
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * Constructor.
     *
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * Action to redirect based on a RedirectRouteInterface route.
     *
     * @param RedirectRouteInterface $redirectRoute
     *
     * @return RedirectResponse
     */
    public function redirectAction(RedirectRouteInterface $redirectRoute)
    {
        $url = $redirectRoute->getUri();

        if (!$url) {
            $routeTarget = $redirectRoute->getRouteTarget();
            if (null !== $routeTarget) {
                $url = $this->router->generate($routeTarget, $redirectRoute->getParameters());
            } else {
                $url = $this->router->generate($redirectRoute->getRouteName(), $redirectRoute->getParameters());
            }
        }

        $status = $redirectRoute->isPermanent() ? 301 : 302;

        return new RedirectResponse($url, $status);
    }
}
