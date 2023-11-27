<?php

namespace App\DataFixtures;

use App\Entity\Niveau;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class NiveauFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $datas=["L1","L2","L3"];

      for ($i=0; $i <count($datas) ; $i++) { 
            $data = new Niveau();
            $data->setLibelle($datas[$i]);
            $data->setIsArchived(false);
            $manager->persist($data);//insertion
            $this->addReference("Niveau".$i,$data);
      }
      $manager->flush();
       
    }
}