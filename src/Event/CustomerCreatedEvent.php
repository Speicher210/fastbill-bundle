<?php

namespace Speicher210\FastbillBundle\Event;

use JMS\Serializer\Annotation as JMS;

/**
 * Event when a customer is created.
 */
class CustomerCreatedEvent extends AbstractNotificationEvent
{
    /**
     * {@inheritdoc}
     */
    public static function getNotificationType()
    {
        return 'customer.created';
    }
}
