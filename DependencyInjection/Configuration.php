<?php

namespace Goleadsit\AdminBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface {

    /**
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder
     */
    public function getConfigTreeBuilder() {
        $treeBuilder = new TreeBuilder('goleadsit_admin');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('title')
                    ->defaultValue('GoleadsIt')
                ->end()
                ->scalarNode('skin')
                    ->defaultValue('skin-blue')
                    ->info('Valores disponibles: skin-blue, skin-blue-light, skin-yellow, skin-yellow-light, skin-green, skin-green-light, skin-purple, skin-purple-light, skin-red, skin-red-light, skin-black, skin-black-light ')
                ->end()
                ->scalarNode('user_profile_path')
                    ->defaultNull()
                    ->info('Nombre de la ruta asociada a la página de perfil de usuario, si no está definida esta opción no aparece')
                ->end()
                ->scalarNode('user_logout_path')
                    ->defaultNull()
                    ->info('Nombre de la ruta asociada al logout de usuario, si no está definida esta opción no aparece')
                ->end()
                ->arrayNode('navbar')->canBeDisabled()
                    ->children()
                        ->booleanNode('is_fixed')->defaultTrue()->end()
                        ->scalarNode('logo_path')
                            ->defaultValue('homepage')
                            ->info('Nombre del path donde redirige al hacer click sobre el logo')
                        ->end()
                        ->scalarNode('logo_mini')
                            ->defaultValue('<b>G</b>LI')
                            ->info('String HTML para mostrar el nombre (Logo) cuando el navbar no está expandido')
                        ->end()
                        ->scalarNode('logo_lg')
                            ->defaultValue('<b>GoLeads</b>It')
                            ->info('String HTML para  mostrar el nombre (Logo) cuando el navbar está expandido')
                        ->end()
                        ->booleanNode('messages')->defaultFalse()->end()
                        ->booleanNode('notifications')->defaultFalse()->end()
                        ->booleanNode('tasks')->defaultFalse()->end()
                    ->end()
                ->end() // navbar
                ->arrayNode('sidebar')->canBeDisabled()
                    ->children()
                        ->booleanNode('is_collapsed')->defaultFalse()->end()
                        ->booleanNode('has_user')->defaultTrue()->end()
                    ->end()
                ->end() // sidebar
                ->append($this->getMenuParameters()) // Menu
                ->arrayNode('providers')->canBeDisabled()
                    ->children()
                        ->scalarNode('messages')->defaultNull()->end()
                        ->scalarNode('notifications')->defaultNull()->end()
                        ->scalarNode('tasks')->defaultNull()->end()
                        ->scalarNode('user')->defaultNull()->end()
                    ->end()
                ->end() // providers
            ->end()
        ;

        return $treeBuilder;
    }

    public function getMenuParameters() {
        $menuTreeBuilder =  new TreeBuilder('menu');

        $node = $menuTreeBuilder->getRootNode()
            ->useAttributeAsKey('name')
            ->arrayPrototype() // First Level
                ->children()
                    ->scalarNode('label')->end()
                    ->scalarNode('route')->defaultValue('#')->end()
                    ->scalarNode('icon')->defaultValue('fa-circle-o')->end()
                    ->arrayNode('options')->canBeDisabled()
                        ->children()
                            ->scalarNode('is_active')->defaultFalse()->end()
                            ->scalarNode('is_header')->defaultFalse()->end()
                        ->end()
                    ->end()
                    ->arrayNode('childs')->canBeUnset()
                        ->useAttributeAsKey('name')
                        ->arrayPrototype() // Second Level
                            ->children()
                                ->scalarNode('label')->end()
                                ->scalarNode('route')->defaultValue('#')->end()
                                ->scalarNode('icon')->defaultValue('fa-circle-o')->end()
                                ->arrayNode('options')->canBeDisabled()
                                    ->children()
                                        ->scalarNode('is_active')->defaultFalse()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('childs')->canBeUnset()
                                    ->useAttributeAsKey('name')
                                    ->arrayPrototype() // Third Level
                                        ->children()
                                            ->scalarNode('label')->end()
                                            ->scalarNode('route')->defaultValue('#')->end()
                                            ->scalarNode('icon')->defaultValue('fa-circle-o')->end()
                                            ->arrayNode('options')->canBeDisabled()
                                                ->children()
                                                    ->scalarNode('is_active')->defaultFalse()->end()
                                                ->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $node;
    }

}
