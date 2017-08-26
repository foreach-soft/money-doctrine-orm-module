<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   2017 Foreach.Soft Ltd. (http://each.uz)
 */
namespace Fes\Money\DoctrineOrmModule;

use Doctrine\ORM\Mapping\Driver\XmlDriver;
use Fes\Money\DoctrineOrmModule\Type\CurrencyType;

return [
    'doctrine' => [
        'driver' => [
            'fes_money_driver' => [
                'class' => XmlDriver::class,
                'paths' => __DIR__ . '/../data/doctrine/xml_mapping',
            ],
            'orm_default' => [
                'drivers' => [
                    'Fes\\Money' => 'fes_money_driver',
                ],
            ],
        ],
        'configuration' => [
            'orm_default' => [
                'types' => [
                    CurrencyType::NAME => CurrencyType::class,
                ],
            ],
        ],
    ],
];
