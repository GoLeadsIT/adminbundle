<?php

namespace Goleadsit\AdminBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class GoleadsitAdminExtension extends Extension {

    public function load(array $configs, ContainerBuilder $container) {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition('goleadsit_admin.config_manager');

        $this->setProviders($container, $config)
             ->setArguments($definition, $config);
    }

    public function getAlias() {
        return 'goleadsit_admin';
    }

    /**
     * Cambia el alias para los providers configurados
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     * @param array                                                   $config
     *
     * @return $this
     */
    private function setProviders(ContainerBuilder $container, array $config) {
        if($config['providers']['messages'] !== NULL) {
            $container->setAlias('goleadsit_admin.messages_provider', $config['providers']['messages']);
        }
        if($config['providers']['notifications'] !== NULL) {
            $container->setAlias('goleadsit_admin.notifications_provider', $config['providers']['notifications']);
        }
        if($config['providers']['tasks'] !== NULL) {
            $container->setAlias('goleadsit_admin.tasks_provider', $config['providers']['tasks']);
        }
        if($config['providers']['user'] !== NULL) {
            $container->setAlias('goleadsit_admin.user_provider', $config['providers']['user']);
        }

        return $this;
    }

    /**
     * Configura los parametros
     *
     * @param \Symfony\Component\DependencyInjection\Definition $definition
     * @param array                                             $config
     *
     * @return $this
     */
    private function setArguments(Definition $definition, array $config) {
        $definition->setArgument(5, [
            'title'             => $config['title'],
            'skin'              => $config['skin'],
            'user_profile_path' => $config['user_profile_path'],
            'user_logout_path'  => $config['user_logout_path']
        ]);
        $definition->setArgument(6, $config['navbar']);
        $definition->setArgument(7, $config['sidebar']);
        $definition->setArgument(8, $config['menu']);

        return $this;
    }

}
