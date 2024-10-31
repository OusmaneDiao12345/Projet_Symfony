<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AccountCreationSubscriber implements EventSubscriberInterface
{
    public function onMailer($event): void
    {
        // ...
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'Mailer' => 'onMailer',
        ];
    }
}
