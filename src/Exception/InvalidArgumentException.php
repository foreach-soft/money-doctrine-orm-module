<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   2017 Foreach.Soft Ltd. (http://each.uz)
 */
declare(strict_types=1);

namespace Fes\Money\DoctrineOrmModule\Exception;

class InvalidArgumentException extends Exception
{
    protected $message = "Invalid argument.";
}
