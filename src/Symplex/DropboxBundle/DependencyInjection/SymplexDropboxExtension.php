<?php

namespace Symplex\DropboxBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SymplexDropboxExtension extends Extension {

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container) {
//        $configuration = new Configuration();
//        $config = $this->processConfiguration($configuration, $configs);
        $config = array();
        foreach ($configs as $subConfig) {
            $config = array_merge($config, $subConfig);
        }

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');


        if (!isset($config['consumerkey'])) {
            throw new \InvalidArgumentException('The "consumerkey" option must be set');
        }
        if (!isset($config['consumersecret'])) {
            throw new \InvalidArgumentException('The "consumersecret" option must be set');
        }


        $container->setParameter('symplex_dropbox.manager.consumerkey', $config['consumerkey']);
        $container->setParameter('symplex_dropbox.manager.consumersecret', $config['consumersecret']);
    }

}
