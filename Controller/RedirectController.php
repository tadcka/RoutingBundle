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

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\RouterInterface;
use Tadcka\Component\Routing\Model\Manager\RedirectRouteManagerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 8/28/14 12:23 PM
 */
class RedirectController
{
    /**
     * @var RedirectRouteManagerInterface
     */
    private $redirectRouteManager;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * Constructor.
     *
     * @param RedirectRouteManagerInterface $redirectRouteManager
     * @param RouterInterface $router
     */
    public function __construct(RedirectRouteManagerInterface $redirectRouteManager, RouterInterface $router)
    {
        $this->router = $router;
        $this->redirectRouteManager = $redirectRouteManager;
    }

    /**
     * Action to redirect based on a RedirectRouteInterface route.
     *
     * @param string $redirectRouteName
     *
     * @return RedirectResponse
     *
     * @throws NotFoundHttpException
     */
    public function redirectAction($redirectRouteName)
    {
        $redirectRoute = $this->redirectRouteManager->findByName($redirectRouteName);
        if (null === $redirectRoute) {
            throw new NotFoundHttpException();
        }

        $url = $redirectRoute->getUri();

        if (!$url) {
            $routeTarget = $redirectRoute->getRouteTarget();
            if (null !== $routeTarget) {
                $url = $this->router->generate($routeTarget, $redirectRoute->getParameters(), true);
            } else {
                $url = $this->router->generate($redirectRoute->getRouteName(), $redirectRoute->getParameters(), true);
            }
        }

        $status = $redirectRoute->isPermanent() ? 301 : 302;

        return new RedirectResponse($url, $status);
    }
}
