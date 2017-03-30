<?php

namespace Cl4u\Bundle\EpicEditorBundle\Formatter;

/**
 * OptionsFormatterInterface
 */
interface OptionsFormatterInterface
{
    /**
     * Format Epic editor options for the frontend
     *
     * @param array $options
     *
     * @return string
     */
    function format($options);
}