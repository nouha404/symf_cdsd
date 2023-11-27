<?php

namespace App\DataFixtures;

use App\Entity\Grade;
use App\Repository\GradeRepository;
use Doctrine\Persistence\ObjectManager;
use App\Repository\ProfesseurRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class GradeFixtures extends Fixture implements DependentFixtureInterface
{

    private ProfesseurRepository $professeurRepository;
    public function __construct(ProfesseurRepository $professeurRepository)
    {
       $this->professeurRepository=$professeurRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $datas = ["MASTER", "LICENCE", "RH", "Attache programme"];

        foreach ($datas as $i => $profData) { 
            $grade = new Grade();

            $refProfesseur=rand(0,3);
            $professeur = $this->getReference("Professeur". $refProfesseur);

            
            $result=$this->professeurRepository->findOneBy(["nomComplet"=> $professeur]);
            if($result==null){
                $grade->setLibelle($profData);
                $grade->setProfesseur($professeur);
            }

            $manager->persist($grade);//insertion
        }

        $manager->flush();
    }

    public function getDependencies(){
        return array(
            ProfesseurFixtures::class
        );
       }
}
