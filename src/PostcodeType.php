<?php

namespace VasilDakov\Postcode\Doctrine;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
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

    /**
     * {@inheritdoc}
     *
     * @param string|null                               $value
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Postcode($value);
    }


    /**
     * {@inheritdoc}
     *
     * @param Postcode|null                             $value
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }

        if ($value instanceof Postcode || Postcode::isValid($value)) {
            return (string) $value;
        }

        throw ConversionException::conversionFailed($value, self::NAME);
    }


    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getName()
    {
        return self::POSTCODE;
    }


    /**
     * {@inheritdoc}
     *
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform
     * @return boolean
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}
