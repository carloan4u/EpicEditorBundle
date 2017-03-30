<?php

namespace Cl4u\Bundle\EpicEditorBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class Cl4uEpicEditorExtension extends Extension
{
    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $this->addParameters($config, $container);
        $this->registerResources($container);
    }

    /**
     * Register the twig template
     *
     * @param ContainerBuilder $container
     */
    protected function registerResources(ContainerBuilder $container)
    {
        $templatingEngines = $container->getParameter('templating.engines');

        if (in_array('twig', $templatingEngines)) {
            $twigFormResources = $container->hasParameter('twig.form.resources')
                ? $container->getParameter('twig.form.resources')
                : array();

            $container->setParameter(
                'twig.form.resources',
                array_merge($twigFormResources, array('Cl4uEpicEditorBundle:Form:epic_editor_widget.html.twig'))
            );
        }
    }

    /**
     * Set container parameters from the given configuration
     *
     * @param array            $config
     * @param ContainerBuilder $container
     */
    protected function addParameters(array $config, ContainerBuilder $container)
    {
        $recursiveIteratorIterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($config));

        $result = array();
        foreach ($recursiveIteratorIterator as $leafValue) {
            $keys = array();
            foreach (range(0, $recursiveIteratorIterator->getDepth()) as $depth) {
                $keys[] = $recursiveIteratorIterator->getSubIterator($depth)->key();
            }

            $result[join('.', $keys)] = $leafValue;
        }

        foreach ($config as $key => $value) {
            $container->setParameter('cl4u_epic_editor.' . $key, $value);
        }
    }
}
