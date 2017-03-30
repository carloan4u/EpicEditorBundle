<?php

namespace Form;

use Cl4u\Bundle\EpicEditorBundle\Form\EpicEditorType;

/**
 * EpicEditorTypeTest
 */
class EpicEditorTypeTest extends \PHPUnit_Framework_TestCase
{
    protected function getOptionsFormatterMock()
    {
        return $this->getMock('Cl4u\Bundle\EpicEditorBundle\Formatter\OptionsFormatterInterface');
    }

    protected function getFormViewMock()
    {
        return $this->getMock('Symfony\Component\Form\FormView');
    }

    protected function getFormInterfaceMock()
    {
        return $this->getMock(
            'Symfony\Component\Form\Form',
            array(),
            array(),
            '',
            false
        );
    }

    protected function getMockOptionsResolver()
    {
        return $this->getMock('Symfony\Component\OptionsResolver\OptionsResolverInterface');
    }

    protected function getFormOptions()
    {
        return array(
            'use_native_fullscreen' => false
        );
    }

    public function getEpicEditorType()
    {
        return new EpicEditorType($this->getFormOptions(), $this->getOptionsFormatterMock());
    }

    public function test_it_should_extend_abstractype()
    {
        $this->assertInstanceOf('\Symfony\Component\Form\AbstractType', $this->getEpicEditorType());
    }

    public function test_it_should_return_its_name()
    {
        $this->assertEquals('epic_editor', $this->getEpicEditorType()->getName());
    }

    public function test_it_should_set_default_options_on_the_options_resolver()
    {
        $formOptions = array(
            'options' => $this->getFormOptions()
        );
        $mockResolver = $this->getMockOptionsResolver();
        $mockResolver->expects($this->any())
            ->method('setDefaults')
            ->with($formOptions);

        $this->getEpicEditorType()->setDefaultOptions($mockResolver);
    }

    public function test_it_should_pass_formatted_options_to_the_frontend()
    {
        $formattedOptions = "{'formatted' :'options'}";
        $optionsFormatter = $this->getOptionsFormatterMock();
        $optionsFormatter->expects($this->any())
            ->method('format')
            ->will($this->returnValue($formattedOptions));

        $epicEditor = new EpicEditorType($this->getFormOptions(), $optionsFormatter);

        $formViewMock      = $this->getFormViewMock();

        $epicEditor->buildView($formViewMock, $this->getFormInterfaceMock(), array());
        $this->assertEquals($formattedOptions, $formViewMock->vars['options']);
    }
}