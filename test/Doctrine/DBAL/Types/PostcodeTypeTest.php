<?php

namespace VasilDakovTest\Doctrine\DBAL\Types;

use VasilDakov\Doctrine\DBAL\Types\PostcodeType;

class PostcodeTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function classHasPostcodeConstant()
    {
        $reflection = new \ReflectionClass(PostcodeType::class);

        $this->assertEquals($reflection->getConstant('POSTCODE'), 'postcode');
    }
}