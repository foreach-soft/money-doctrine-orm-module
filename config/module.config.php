<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   2017 Foreach.Soft Ltd. (http://each.uz)
 */
namespace Fes\Money\DoctrineOrmModule;

use Doctrine\ORM\Mapping\Driver\XmlDriver;
use Fes\Money\Currency\Currencies\NullCurrency;
use Fes\Money\DoctrineOrmModule\Listener\TypesRegistrationListener;
use Fes\Money\DoctrineOrmModule\Type\CurrencyType;
use Fes\Money\Currency\Currencies\Eur;
use Fes\Money\Currency\Currencies\Gbp;
use Fes\Money\Currency\Currencies\Rub;
use Fes\Money\Currency\Currencies\Usd;
use Fes\Money\Currency\Currencies\Uzs;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'service_manager' => [
        'factories' => [
            TypesRegistrationListener::class => InvokableFactory::class,
        ],
    ],
    'listeners' => [
        TypesRegistrationListener::class,
    ],
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
    'fes_money_doctrine' => [
        'currencies' => [
            'NO_CURRENCY' => NullCurrency::class,
            'EUR' => Eur::class,
            'GBP' => Gbp::class,
            'RUB' => Rub::class,
            'USD' => Usd::class,
            'UZS' => Uzs::class,
        ],
    ],
];
