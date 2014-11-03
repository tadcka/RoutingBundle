<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Bundle\RoutingBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 7/1/14 11:09 PM
 */
class TadckaRoutingExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('chain-router.xml');
        $loader->load('controllers.xml');
        $loader->load('dynamic-router.xml');
        $loader->load('form/redirect-route.xml');
        $loader->load('form/route.xml');
        $loader->load('helpers.xml');
        $loader->load('services.xml');

        if (!in_array(strtolower($config['db_driver']), array('mongodb', 'orm'))) {
            throw new \InvalidArgumentException(sprintf('Invalid db driver "%s".', $config['db_driver']));
        }
        $loader->load('db_driver/' . sprintf('%s.xml', $config['db_driver']));

        $container->setParameter($this->getAlias() . '.model.route.class', $config['class']['model']['route']);
        $container->setParameter(
            $this->getAlias() . '.model.redirect_route.class',
            $config['class']['model']['redirect_route']
        );

        $container->setAlias($this->getAlias() . '.manager.route', $config['route_manager']);
        $container->setAlias($this->getAlias() . '.manager.redirect_route', $config['redirect_route_manager']);

        $container->setParameter($this->getAlias() . '.chain_router.enabled', $config['chain_router']['enabled']);
        $container->setParameter($this->getAlias() . '.dynamic_router.priority', $config['dynamic_router']['priority']);
        $container->setParameter($this->getAlias() . '.router.priority', $config['router']['priority']);

        $container->setParameter($this->getAlias() . '.locales', $config['locales']);
    }
}
