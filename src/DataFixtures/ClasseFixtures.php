<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use App\Repository\ClasseRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ClasseFixtures extends Fixture implements DependentFixtureInterface
{
      private ClasseRepository $classeRepository;
      public function __construct(ClasseRepository $classeRepository)
      {
         $this->classeRepository=$classeRepository;
      }

      public function load(ObjectManager $manager): void
       {
       
        for ($i=1; $i <=10 ; $i++) { 
            $data = new Classe();
            $refNiveau=rand(0,2);
            $refFiliere=rand(0,3);

            $niveau=$this->getReference("Niveau". $refNiveau);//Objet
            $filiere=$this->getReference("Filiere". $refFiliere);//Objet
            
            $nomClasse=$niveau->getLibelle()."".$filiere->getLibelle();
            $result=$this->classeRepository->findOneBy(["nomClasse"=> $nomClasse]);
            
            if($result==null){
                $data->setNomClasse($nomClasse);
                $data->setFiliere($filiere);
                $data->setNiveau($niveau);
                $data->setIsArchived(false);
                $this->addReference("Classe".$i,$data);
                $manager->persist($data);//insertion
              }else{
                $i--;
              }
             
        }
         $manager->flush();
    }

    public function getDependencies(){
    return array(
        FiliereFixtures::class,
        NiveauFixtures::class
    ); 
   }
}