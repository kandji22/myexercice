<?php

namespace App\Controller;

use App\Event\MyEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    public function index(Request $request,TranslatorInterface $translator): Response
    {

        $this->addFlash('success',$translator->trans('Your are success'));
        return $this->render('home/index.html.twig', [

        ]);
    }


    /**
     * @Route("/admin/chief", name="admin_chief")
     */
    public function admin(): Response
    {
        dd('ok chief');
    }

    /**
     * @Route("/noadmin", name="no_admin")
     */
    public function noAdmin(): Response
    {
        dd('vous n ete pas admin raison pour la quel');
    }

    /**
     * @Route("/changelocal/{_locale}", name="change_local")
     */
    public function changeLocal(Request $request,TranslatorInterface $translator): Response
    {
        $locale = $request->get('_locale');
        //php bin/console debug:container --parameters (affiche les parameters)
        /*$cacheDir = $this->getParameter('kernel.cache_dir');
        $fileSyltem = new Filesystem();
        $fileSyltem->remove($cacheDir.'/dev');
        $lang = $request->get('locale');
        $request->getSession()->set('_locale',$lang);
        $request->setLocale($lang);*/

        $request->getSession()->set('_locale',$locale);
        $this->addFlash('success',$translator->trans('the langage is changed '));
        return  $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("/mylisterner",name="my_listerner")
     */
    public function myListerner(EventDispatcherInterface $dispatcher) {
        $event = new MyEvent();
        $dispatcher->dispatch($event);
        dd('doule');
    }
}
