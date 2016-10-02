<?php

namespace VasilDakov\Doctrine\DBAL\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class PostcodeType extends Type
{
    const POSTCODE = 'postcode';


    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'postcode';
    }


    public function getName()
    {
        return self::POSTCODE;
    }
}