<?php

namespace Speicher210\FastbillBundle\Event;

use JMS\Serializer\Annotation as JMS;

/**
 * Event when a subscription is closed.
 */
class SubscriptionClosedEvent extends AbstractNotificationEvent
{
    /**
     * {@inheritdoc}
     */
    public static function getNotificationType()
    {
        return 'subscription.closed';
    }
}
