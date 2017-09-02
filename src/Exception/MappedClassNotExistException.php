<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   2017 Foreach.Soft Ltd. (http://each.uz)
 */
declare(strict_types=1);

namespace Fes\Money\DoctrineOrmModule\Exception;

class MappedClassNotExistException extends Exception
{
    protected $message = "Mapped class not exist.";

    /**
     * @param string $class
     * @return MappedClassNotExistException
     */
    public static function fromClassName(string $class): self
    {
        return new static(sprintf("Mapped class '%s' not exist.", $class));
    }
}
