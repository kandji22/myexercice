<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class ChangeLocalSubscriber implements EventSubscriberInterface
{
    public function onRequestEvent($event)
    {
        $request = $event->getRequest();
        //$request->getSession()->remove('locale');

        if (!$request->hasPreviousSession()) {
            return;
        }

        // On vérifie si la langue est passée en paramètre de l'URL
        $locale = $request->get('_locale');

        if ($locale) {
            $request->setLocale($locale);
            $request->getSession()->set('_locale',$locale);

        } else {
                if($request->getSession()->get('_locale')) {
                    // Sinon on utilise celle de la session
                    $request->setLocale($request->getSession()->get('_locale', 'en'));
                }
            }

    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onRequestEvent',
        ];
    }
}
