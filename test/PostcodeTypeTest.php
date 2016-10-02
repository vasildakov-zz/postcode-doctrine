<?php

namespace VasilDakovTest\Postcode\Doctrine;

use Doctrine\DBAL\Types\Type;
use Doctrine\Tests\DBAL\Mocks\MockPlatform;
use VasilDakov\Postcode\Postcode;

use VasilDakov\Postcode\Doctrine\PostcodeType;

class PostcodeTypeTest extends \PHPUnit_Framework_TestCase
{
    private $platform;

    private $type;

    public static function setUpBeforeClass()
    {
        if (class_exists('Doctrine\\DBAL\\Types\\Type')) {
            Type::addType('postcode', 'VasilDakov\Postcode\Doctrine\PostcodeType');
        }
    }

    protected function setUp()
    {
        $this->platform = $this->getPlatformMock();

        $this->platform
             ->expects($this->any())
             ->method('getGuidTypeDeclarationSQL')
             ->will($this->returnValue('DUMMYVARCHAR()'))
        ;

        $this->type = Type::getType('postcode');
    }


    /**
     * @covers \VasilDakov\Postcode\Doctrine\PostcodeType::convertToDatabaseValue
     */
    public function testPostcodeConvertsToDatabaseValue()
    {
        $postcode = new Postcode('TW8 8FB');
        $expected = (string) $postcode;
        $actual = $this->type->convertToDatabaseValue($postcode, $this->platform);
        $this->assertEquals($expected, $actual);
    }


    /**
     * @covers \VasilDakov\Postcode\Doctrine\PostcodeType::convertToDatabaseValue
     */
    public function testNullConversionForDatabaseValue()
    {
        $this->assertNull($this->type->convertToDatabaseValue(null, $this->platform));
    }


    /**
     * @covers \VasilDakov\Postcode\Doctrine\PostcodeType::convertToPHPValue
     */
    public function testPostcodeConvertsToPHPValue()
    {
        $postcode = $this->type->convertToPHPValue('TW8 8FB', $this->platform);
        $this->assertInstanceOf('VasilDakov\Postcode\Postcode', $postcode);
        $this->assertEquals('TW8 8FB', (string)$postcode);
    }


    /**
     * @covers \VasilDakov\Postcode\Doctrine\PostcodeType::convertToPHPValue
     */
    public function testInvalidPostcodeConversionForPHPValue()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->type->convertToPHPValue('ABC DEF', $this->platform);
    }



    /**
     * @covers \VasilDakov\Postcode\Doctrine\PostcodeType::requiresSQLCommentHint
     */
    public function testRequiresSQLCommentHint()
    {
        $this->assertTrue($this->type->requiresSQLCommentHint($this->platform));
    }


    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getPlatformMock()
    {
        return $this->getMockBuilder('Doctrine\DBAL\Platforms\AbstractPlatform')
            ->setMethods(array('getGuidTypeDeclarationSQL'))
            ->getMockForAbstractClass()
        ;
    }

}
