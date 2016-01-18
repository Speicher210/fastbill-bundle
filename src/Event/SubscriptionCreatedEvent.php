<?php

namespace Speicher210\FastbillBundle\Event;

use JMS\Serializer\Annotation as JMS;

/**
 * Event when a subscription is created.
 */
class SubscriptionCreatedEvent extends AbstractNotificationEvent
{
    /**
     * {@inheritdoc}
     */
    public static function getNotificationType()
    {
        return 'subscription.created';
    }
}
