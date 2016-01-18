<?php

namespace Speicher210\FastbillBundle\Event;

use JMS\Serializer\Annotation as JMS;

/**
 * Event when a payment is created.
 */
class PaymentCreatedEvent extends AbstractNotificationEvent
{
    /**
     * {@inheritdoc}
     */
    public static function getNotificationType()
    {
        return 'payment.created';
    }
}
