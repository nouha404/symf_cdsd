<?php

namespace App\DataFixtures;

use App\Entity\Module;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Repository\ProfesseurRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ModuleFixtures extends Fixture implements DependentFixtureInterface
{

     //injection de dependance
     private ProfesseurRepository $professeurRepository;

     public function __construct(ProfesseurRepository $professeurRepository) {
         $this->professeurRepository=$professeurRepository;
     }



    public function load(ObjectManager $manager): void
    {
        $datas=["JAVA","ALGO","PHP","PYTHON","SYMFONY"];

        for ($i=0; $i <count($datas) ; $i++) {
            $module = new Module();
            //$moduleReference = "Module" . $i;
            
            $refProfesseur = rand(0, 9);
            $professeur = $this->getReference("Professeur". $refProfesseur);

          
            
            $result=$this->professeurRepository->findOneBy(["nomComplet"=> $professeur]);
            if($result== null){
                $module->setLibelle($datas[$i]);
                $module->setProfesseur($professeur);
                $module->setIsArchived(false);
               
            }  
            $manager->persist($module);//insertion
            $this->addReference("Module".$i,$module);

            
        }

        $manager->flush();
    }

    public function getDependencies(){
        return array(
            ProfesseurFixtures::class
        );
       }


}