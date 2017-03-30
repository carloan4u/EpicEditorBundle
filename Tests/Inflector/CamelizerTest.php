<?php

namespace Inflector;

use Cl4u\Bundle\EpicEditorBundle\Inflector\Camelizer;

/**
 * CamelizerTest
 */
class CamelizerTest extends \PHPUnit_Framework_TestCase
{
    protected $camelizer;

    public function setUp()
    {
        $this->camelizer = new Camelizer();
    }

    public function test_it_converts_underscored_strings_to_camelcase()
    {
        $this->assertEquals('helloWorld', $this->camelizer->inflect('hello_world'));
    }

    public function test_it_does_nothing_with_camelcased_strings()
    {
        $this->assertEquals('helloWorld', $this->camelizer->inflect('helloWorld'));
    }

    public function test_it_strips_special_characters()
    {
        $this->assertEquals('helloWorld', $this->camelizer->inflect('hello_world_%%%'));
    }
}