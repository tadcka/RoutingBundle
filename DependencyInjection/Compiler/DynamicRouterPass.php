<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 7/11/14 10:00 PM
 */
class DynamicRouterPass implements CompilerPassInterface
{

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->getParameter('tadcka_routing.chain_router.enabled')) {
            if (false === $container->hasDefinition('tadcka_routing.dynamic_router')) {
                return null;
            }

            $dynamicRouter = $container->getDefinition('tadcka_routing.dynamic_router');

            $dynamicRouter->addTag(
                'router',
                array(
                    'priority' => $container->getParameter('tadcka_routing.dynamic_router.priority')
                )
            );
        }
    }
}
