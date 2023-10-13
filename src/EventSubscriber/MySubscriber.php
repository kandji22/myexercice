<?php
namespace App\EventSubscriber;
use App\Event\MyEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MySubscriber implements EventSubscriberInterface {

    public static function getSubscribedEvents(): array
    {
        return [
            MyEvent::class => 'getMail'
        ];
    }

    public function getMail(MyEvent $event) {
        dd($event->getMail());
    }
}