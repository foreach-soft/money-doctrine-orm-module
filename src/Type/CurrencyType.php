<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   2017 Foreach.Soft Ltd. (http://each.uz)
 */
declare(strict_types=1);

namespace Fes\Money\DoctrineOrmModule\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use Fes\Money\Currency\CurrencyInterface;
use Fes\Money\DoctrineOrmModule\Exception\CurrencyNotMappedException;
use Fes\Money\DoctrineOrmModule\Exception\InvalidArgumentException;

class CurrencyType extends Type
{
    const NAME = 'fes_money_currency';

    /**
     * @var string[]
     */
    protected static $classMap = [];

    /**
     * @inheritdoc
     */
    public static function convertToDatabase($value)
    {
        if (!is_subclass_of($value, CurrencyInterface::class)) {
            throw new ConversionException(
                sprintf("Invalid currency or given currency not instance of %s", CurrencyInterface::class)
            );
        }

        $databaseValue = array_search(is_string($value) ? $value : get_class($value), self::$classMap);

        if ($databaseValue === false) {
            throw CurrencyNotMappedException::fromClassName(is_string($value) ? $value : get_class($value));
        }

        return $databaseValue;
    }

    /**
     * @param string $name
     * @param string $class
     * @throws InvalidArgumentException
     */
    public static function map(string $name, string $class)
    {
        // class existence check
        $object = new $class();

        if (!$object instanceof CurrencyInterface) {
            throw new InvalidArgumentException(
                sprintf("Class must implement '%s'", CurrencyInterface::class)
            );
        }

        self::$classMap[$name] = $class;
    }

    /**
     * @inheritdoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getVarcharTypeDeclarationSQL(
            array_merge(
                $fieldDeclaration,
                ['length' => 255, 'nullable' => false]
            )
        );
    }

    /**
     * @inheritdoc
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (!isset(self::$classMap[$value])) {
            throw CurrencyNotMappedException::fromDatabaseValue($value);
        }

        return new self::$classMap[$value];
    }

    /**
     * @inheritdoc
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        $databaseValue = array_search(get_class($value), self::$classMap);

        if ($databaseValue === false) {
            throw CurrencyNotMappedException::fromClassName(get_class($value));
        }

        return $databaseValue;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return self::NAME;
    }
}
