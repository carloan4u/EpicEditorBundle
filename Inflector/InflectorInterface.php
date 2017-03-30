<?php

namespace Cl4u\Bundle\EpicEditorBundle\Inflector;

/**
 * InflectorInterface
 */
interface InflectorInterface
{
    /**
     * Change the grammatical form of a string
     *
     * @param string $string
     *
     * @return string
     */
    function inflect($string);
}