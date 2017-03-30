<?php

namespace Cl4u\Bundle\EpicEditorBundle\Formatter;

use Cl4u\Bundle\EpicEditorBundle\Inflector\InflectorInterface;

/**
 * JsonOptionsFormatter
 */
class JsonOptionsFormatter implements OptionsFormatterInterface
{
    /**
     * The Inflector to use
     *
     * @var InflectorInterface
     */
    protected $inflector;

    /**
     * Constructor
     *
     * @param InflectorInterface $inflector
     */
    public function __construct(InflectorInterface $inflector)
    {
        $this->inflector = $inflector;
    }

    /**
     * Convert an array of options to a JavaScript object
     *
     * @param array $options
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function format($options)
    {
        if (!is_array($options)) {
            throw new \InvalidArgumentException();
        }

        $options     = $this->camelizeArrayKeys($options);
        $jsonOptions = json_encode($options, JSON_PRETTY_PRINT);

        return $this->unquotePropertyValue($jsonOptions, 'parser', $options['parser']);
    }

    /**
     * Remove the quotes around a JSON object property value
     *
     * @param string $jsonOptions
     * @param string $propertyName
     * @param string $value
     *
     * @return mixed
     */
    private function unquotePropertyValue($jsonOptions, $propertyName, $value)
    {
        return str_replace('"' . $propertyName . '": "' . $value . '"', '"'.$propertyName.'": ' . $value, $jsonOptions);
    }

    /**
     * Convert array keys to camel case
     *
     * @param array $array
     *
     * @return array
     * @throws \InvalidArgumentException
     */
    protected function camelizeArrayKeys($array)
    {
        if (!is_array($array)) {
            throw new \InvalidArgumentException('This method only accepts an array');
        }

        $camelizedArray = array();
        foreach ($array as $key => $value) {
            $camelKey = $this->inflector->inflect($key);

            if (is_array($value)) {
                $camelizedArray[$camelKey] = $this->camelizeArrayKeys($value);
                continue;
            }

            $camelizedArray[$camelKey] = $value;
        }

        return $camelizedArray;
    }
}