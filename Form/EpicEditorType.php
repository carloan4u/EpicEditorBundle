<?php

namespace Cl4u\Bundle\EpicEditorBundle\Form;

use Cl4u\Bundle\EpicEditorBundle\Formatter\OptionsFormatterInterface;
use Cl4u\Bundle\EpicEditorBundle\Helper\ArrayKeyCamelizer;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormView;

/**
 * EpicEditorType
 */
class EpicEditorType extends AbstractType
{
    /**
     * The Options
     *
     * @var array
     */
    protected $options;

    /**
     * The Options formatter to use
     *
     * @var OptionsFormatterInterface
     */
    protected $optionsFormatter;

    /**
     * Constructor
     *
     * @param array                     $options
     * @param OptionsFormatterInterface $optionsFormatter
     */
    public function __construct($options, OptionsFormatterInterface $optionsFormatter)
    {
        $this->options          = $options;
        $this->optionsFormatter = $optionsFormatter;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'options' => $this->options
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (array_key_exists('options', $options)) {
            $options = array_merge($this->options, $options['options']);
        }

        $view->vars['options'] = $this->optionsFormatter->format($options);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'textarea';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'epic_editor';
    }
}