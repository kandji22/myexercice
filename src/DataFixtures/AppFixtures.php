<?php

namespace App\DataFixtures;

use App\Entity\Departement;
use App\Entity\MynewFile;
use App\Entity\Region;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\File;

class AppFixtures extends Fixture
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function load(ObjectManager $manager): void
    {

        $dir = $this->container->get('kernel')->getProjectDir();
        $doc = 'public/mesfichier/1.jpeg';
        $path = $dir.'/'.$doc;
        $newFile = new MynewFile();
        $newFile->setImageFile(new File($path));
        $manager->persist($newFile);
        for($i=0; $i<=5; $i++) {
            $region = new Region();
            $region->setName(uniqid());
            $region->addFile($newFile);
            $manager->persist($region);
            for($i=0;$i<=2;$i++) {
              $departement = new Departement();
              $departement->setName(uniqid());
              $departement->setRegion($region);
              $manager->persist($departement);
            }
            $manager->flush();
        }
    }
}
