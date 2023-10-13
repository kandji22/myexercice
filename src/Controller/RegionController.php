<?php

namespace App\Controller;

use App\Entity\Region;
use App\Form\RegionType;
use App\Repository\RegionRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegionController extends AbstractController
{
    private $manager;
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/region", name="app_region")
     */
    public function index(Request $request): Response
    {
        $region = new Region();
        $form = $this->createForm(RegionType::class,$region);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $files = $region->getFile();
            $workDir = $this->getParameter('kernel.project_dir').'/public/mesfichier';
            $tabFile = [];
            foreach ($files as $file) {
                $nameFile = uniqid().$file->getClientOriginalName();
                $file->move($workDir,$nameFile);
                array_push($tabFile,$nameFile);
            }
            $region->setFile($tabFile);
            $this->manager->persist($region);
            $this->manager->flush();
            return $this->redirectToRoute('new_home');
        }
        return $this->render('region/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/region/edit/{id}", name="edit_region")
     */
    public function edit($id,Request $request,RegionRepository $regionRepository): Response
    {

        $region = $regionRepository->find($id);
        //$this->denyAccessUnlessGranted('POST_EDIT',$region);
        $form = $this->createForm(RegionType::class,$region);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $files = $region->getFile();
            $workDir = $this->getParameter('kernel.project_dir').'/public/mesfichier';
            $tabFile = [];
            foreach ($files as $file) {
                $nameFile = uniqid().$file->getClientOriginalName();
                $file->move($workDir,$nameFile);
                array_push($tabFile,$nameFile);
            }
            $region->setFile($tabFile);
            $this->manager->persist($region);
            $this->manager->flush();
            return $this->redirectToRoute('new_home');
        }
        return $this->render('region/edit.html.twig', [
            'form' => $form->createView(),
            'region' => $region
        ]);
    }
    /**
     * @Route("/home/new_home",name="new_home")
     */
    public function new_home() {
        dd('new home create');
    }
}
