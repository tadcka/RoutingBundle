<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Cmf\Component\Routing\DependencyInjection\Compiler\RegisterRouteEnhancersPass;
use Symfony\Cmf\Component\Routing\DependencyInjection\Compiler\RegisterRoutersPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Tadcka\Bundle\RoutingBundle\DependencyInjection\Compiler\ChainRouterPass;
use Tadcka\Bundle\RoutingBundle\DependencyInjection\Compiler\DynamicRouterPass;
use Tadcka\Bundle\RoutingBundle\DependencyInjection\Compiler\SymfonyRouterPass;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 */
class TadckaRoutingBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new SymfonyRouterPass());
        $container->addCompilerPass(new DynamicRouterPass());
        $container->addCompilerPass(new ChainRouterPass());
        $container->addCompilerPass(new RegisterRoutersPass('tadcka_routing.chain_router'));
        $container->addCompilerPass(new RegisterRouteEnhancersPass('tadcka_routing.dynamic_router'));

        $this->addRegisterMappingsPass($container);
    }

    /**
     * Add register mappings pass.
     *
     * @param ContainerBuilder $container
     */
    private function addRegisterMappingsPass(ContainerBuilder $container)
    {
        $mappings = array(
            realpath(__DIR__ . '/Resources/config/doctrine/base') => 'Symfony\Component\Routing',
            realpath(__DIR__ . '/Resources/config/doctrine/model') => 'Tadcka\Component\Routing\Model',
        );

        $ormCompilerClass = 'Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass';
        if (class_exists($ormCompilerClass)) {
            $container->addCompilerPass(DoctrineOrmMappingsPass::createXmlMappingDriver($mappings));
        }
    }
}
