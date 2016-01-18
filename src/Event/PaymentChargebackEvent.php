<?php

namespace Speicher210\FastbillBundle\Event;

use JMS\Serializer\Annotation as JMS;

/**
 * Event when a payment is chargebacked.
 */
class PaymentChargebackEvent extends AbstractNotificationEvent
{
    /**
     * {@inheritdoc}
     */
    public static function getNotificationType()
    {
        return 'payment.chargeback';
    }
}
