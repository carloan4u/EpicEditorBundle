<?php

namespace Cl4u\Bundle\EpicEditorBundle\Helper;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Templating\Helper\CoreAssetsHelper;

/**
 * JavascriptAssetHelper
 */
class JavascriptAssetHelper
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var string
     */
    protected $javascriptPath;

    /**
     * Constructor
     *
     * @param ContainerInterface $container
     * @param string             $javascriptPath
     */
    public function __construct(ContainerInterface $container, $javascriptPath)
    {
        $this->container      = $container;
        $this->javascriptPath = $javascriptPath;
    }

    /**
     * @return CoreAssetsHelper
     */
    protected function getAssetHelper()
    {
        return $this->container->get('templating.helper.assets');
    }

    /**
     * @return string
     */
    public function getJavascriptUrl()
    {
        return $this->getAssetHelper()->getUrl($this->javascriptPath);
    }
}