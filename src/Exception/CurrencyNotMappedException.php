<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   2017 Foreach.Soft Ltd. (http://each.uz)
 */
declare(strict_types=1);

namespace Fes\Money\DoctrineOrmModule\Exception;

class CurrencyNotMappedException extends \Fes\Money\Exception\Exception
{
    protected $message = "Not mapped currency;";

    /**
     * @param string $value
     * @return CurrencyNotMappedException
     */
    public static function fromClassName(string $value): self
    {
        return new static(sprintf("Currency class '%s' not mapped.", $value));
    }

    /**
     * @param string $value
     * @return CurrencyNotMappedException
     */
    public static function fromDatabaseValue(string $value): self
    {
        return new static(sprintf("Currency '%s' not mapped to class.", $value));
    }
}
