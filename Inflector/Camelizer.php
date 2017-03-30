<?php

namespace Cl4u\Bundle\EpicEditorBundle\Inflector;

/**
 * Camelizer
 */
class Camelizer implements InflectorInterface
{
    /**
     * Convert a string to camelCase
     *
     * @param string $word
     *
     * @return string
     */
    public function inflect($word)
    {
        return lcfirst(str_replace(' ', '', ucwords(preg_replace('/[^A-Z^a-z^0-9]+/', ' ', $word))));
    }
} 