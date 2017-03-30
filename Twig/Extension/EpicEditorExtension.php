<?php

namespace Cl4u\Bundle\EpicEditorBundle\Twig\Extension;

use Cl4u\Bundle\EpicEditorBundle\Helper\JavascriptAssetHelper;

/**
 * EpicEditorExtension
 */
class EpicEditorExtension extends \Twig_Extension
{
    /**
     * @var JavascriptAssetHelper
     */
    protected $javascriptAssetHelper;

    /**
     * Constructor
     *
     * @param JavascriptAssetHelper $javascriptAssetHelper
     */
    public function __construct(JavascriptAssetHelper $javascriptAssetHelper)
    {
        $this->javascriptAssetHelper = $javascriptAssetHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction(
                'epic_editor_javascript',
                array(
                    $this,
                    'getJavaScriptTag'
                ),
                array(
                    'is_safe' => array('html')
                )
            ),
        );
    }

    /**
     * Returns a script tag for including the JavaScript library
     *
     * @return string
     */
    public function getJavascriptTag()
    {
        $scriptUrl = $this->javascriptAssetHelper->getJavascriptUrl();

        return '<script src="' . $scriptUrl . '"></script>';
    }

    /**
     * Get the name of the extension
     *
     * @return string
     */
    public function getName()
    {
        return 'epic_editor_extension';
    }
}