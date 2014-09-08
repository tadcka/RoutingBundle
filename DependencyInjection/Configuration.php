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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 7/1/14 11:09 PM
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('tadcka_routing');

        $rootNode
            ->children()
                ->scalarNode('db_driver')->cannotBeOverwritten()->isRequired()->end()
                ->scalarNode('route_manager')->defaultValue('tadcka_routing.manager.route.default')
                    ->cannotBeEmpty()->end()
                ->scalarNode('redirect_route_manager')->defaultValue('tadcka_routing.manager.redirect_route.default')
                    ->cannotBeEmpty()->end()

                ->arrayNode('class')->isRequired()
                    ->children()
                        ->arrayNode('model')->isRequired()
                            ->children()
                                ->scalarNode('route')->isRequired()->end()
                                ->scalarNode('redirect_route')->isRequired()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()

                ->arrayNode('chain_router')->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('enabled')->defaultFalse()->end()
                    ->end()
                ->end()

                ->arrayNode('dynamic_router')->addDefaultsIfNotSet()
                    ->children()
                        ->integerNode('priority')->defaultValue(0)->end()
                    ->end()
                ->end()

                ->arrayNode('router')->addDefaultsIfNotSet()
                    ->children()
                        ->integerNode('priority')->defaultValue(0)->end()
                    ->end()
                ->end()

                ->arrayNode('locales')
                    ->beforeNormalization()
                        ->ifString()
                        ->then(function($value) { return preg_split('/\s*,\s*/', $value); })
                    ->end()
                    ->requiresAtLeastOneElement()
                    ->prototype('scalar')->end()
                ->end()

            ->end();

        return $treeBuilder;
    }
}
