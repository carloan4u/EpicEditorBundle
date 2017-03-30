<?php

namespace Cl4u\Bundle\EpicEditorBundle\Tests\Twig;

use Cl4u\Bundle\EpicEditorBundle\Twig\Extension\EpicEditorExtension;

/**
 * EpicEditorExtensionTest
 */
class EpicEditorExtensionTest extends \PHPUnit_Framework_TestCase
{

    protected function getJavascriptAssetHelperMock()
    {
        $javascriptAssetHelperMock = $this->getMock(
            'Cl4u\Bundle\EpicEditorBundle\Helper\JavascriptAssetHelper',
            array(),
            array(),
            '',
            false
        );
        $javascriptAssetHelperMock->expects($this->any())
            ->method('getJavascriptUrl')
            ->will($this->returnValue('bundles/cl4uepiceditor/js/epiceditor.min.js'));

        return $javascriptAssetHelperMock;
    }
    public function getExtension()
    {
        return new EpicEditorExtension($this->getJavascriptAssetHelperMock());
    }

    public function test_it_should_extend_twig_extension()
    {
        $this->assertInstanceOf('\Twig_Extension', $this->getExtension());

    }

    public function test_it_should_return_its_name()
    {
        $extension = $this->getExtension();
        $this->assertEquals('epic_editor_extension', $extension->getName());
    }

    public function test_it_should_have_one_function()
    {
        $extension = $this->getExtension();
        $functions = $extension->getFunctions();
        $this->assertEquals(1, count($functions));
    }

    public function test_it_should_return_the_epic_editor_script_tag()
    {
        $extension = $this->getExtension();
        $expected = '<script src="bundles/cl4uepiceditor/js/epiceditor.min.js"></script>';
        $this->assertEquals($expected, $extension->getJavascriptTag());
    }
}