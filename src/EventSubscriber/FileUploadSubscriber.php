<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class FileUploadSubscriber implements EventSubscriberInterface
{
    public function onFileUploadedEvent($event): void
    {
        // ...
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'FileUploadedEvent' => 'onFileUploadedEvent',
        ];
    }
}
