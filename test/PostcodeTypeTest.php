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
     * @test
     */
    public function classHasPostcodeConstant()
    {
        $reflection = new \ReflectionClass(PostcodeType::class);

        $this->assertEquals($reflection->getConstant('POSTCODE'), 'postcode');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getPlatformMock()
    {
        return $this->getMockBuilder('Doctrine\DBAL\Platforms\AbstractPlatform')
            ->setMethods(array('getGuidTypeDeclarationSQL'))
            ->getMockForAbstractClass();
    }

}
