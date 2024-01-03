<?php

namespace App\DataFixtures;

use App\DataFixtures\ClasseFixtures;
use App\DataFixtures\EtudiantFixtures;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\AnneeScolaireFixtures;
use App\Entity\Inscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class InscriptionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <=10; $i++) {
            $data = new Inscription();
            $annee=rand(2018,2023);

            $data->setAnneScolaire($this->getReference("AnneeScolaire".$annee));
            $data ->setClasse($this->getReference("Classe".$i));
            $data->setEtudiant($this->getReference("Etudiant".$i));
            $this->addReference("Inscription".$i,$data);
            $manager->persist($data);
            
            }
            

        $manager->flush();
    }
        
    public function getDependencies(){
        return array(
            ClasseFixtures::class,
            EtudiantFixtures::class,
            AnneeScolaireFixtures::class,
            );
    }
}
