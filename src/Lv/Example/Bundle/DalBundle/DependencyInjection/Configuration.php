<?php

namespace Lv\Example\Bundle\DalBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * LvExampleDalBundle semantical configuration class.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     *
     * @see http://symfony.com/doc/current/components/config/definition.html
     *
     * @example to create configuration tree, use theses lines :
     *      $treeBuilder = new TreeBuilder();
     *      $treeBuilder->root('lv_example_dal')
     *          ->children()
     *              ->scalarNode('...')
     *                  ->isRequired()
     *              ->end()
     *              ->arrayNode()
     *                  ->addDefaultsIfNotSet()
     *                  ->children()
     *                       // more nodes here
     *                  ->end()
     *              ->end()
     *          ->end()
     *      ;
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder->root('lv_example_dal');

        return $treeBuilder;
    }
}
