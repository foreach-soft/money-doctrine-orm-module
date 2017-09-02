<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   2017 Foreach.Soft Ltd. (http://each.uz)
 */
declare(strict_types=1);

namespace Fes\Money\DoctrineOrmModule\Listener;

use Fes\Money\DoctrineOrmModule\Type\CurrencyType;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;

class TypesRegistrationListener extends AbstractListenerAggregate
{
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $events->attach(MvcEvent::EVENT_BOOTSTRAP, [$this, 'mapCurrencies'], 1000);
    }

    /**
     * Registers currencies
     *
     * @param MvcEvent $event
     */
    public function mapCurrencies(MvcEvent $event)
    {
        /**
         * @var string[] $currenciesMap
         */
        $currenciesMap = $event->getApplication()->getServiceManager()->get('config')['fes_money_doctrine']['currencies'] ?? [];

        foreach ($currenciesMap as $databaseIdentifier => $currencyClass) {
            CurrencyType::map($databaseIdentifier, $currencyClass);
        }
    }
}
