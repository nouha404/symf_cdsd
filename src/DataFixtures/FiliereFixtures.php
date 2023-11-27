<?php

namespace App\DataFixtures;


use App\Entity\Filiere;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class FiliereFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $datas=["CDSD","MAIE","GLRS","IAGE"];

      for ($i=0; $i <count($datas) ; $i++) { 
            $data = new Filiere();
            $data->setLibelle($datas[$i]);
            $data->setIsArchived(false);
            $manager->persist($data);//insertion
            $this->addReference("Filiere".$i,$data);
      }
       $manager->flush();
    }
}