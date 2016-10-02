<?php

namespace VasilDakov\Postcode\Doctrine;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use VasilDakov\Postcode\Postcode;

/**
 * class PostcodeType
 * @link https://goo.gl/cG7OEq Doctrine Types
 */
class PostcodeType extends Type
{
    const POSTCODE = 'postcode';


    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'postcode';
    }


    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Postcode($value);
    }


    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return (string) $value;
    }


    public function getName()
    {
        return self::POSTCODE;
    }
}