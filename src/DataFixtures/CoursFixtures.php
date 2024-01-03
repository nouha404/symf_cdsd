<?php

namespace App\DataFixtures;

use App\Entity\Cours;
use App\Repository\ClasseRepository;
use App\Repository\ModuleRepository;
use Doctrine\Persistence\ObjectManager;
use App\Repository\ProfesseurRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CoursFixtures extends Fixture implements DependentFixtureInterface
{
    private ProfesseurRepository $professeurRepository;
    private ClasseRepository $classeRepository;
    private ModuleRepository $moduleRepository;

    public function __construct(
        ProfesseurRepository $professeurRepository,
        ClasseRepository $classeRepository,
        ModuleRepository $moduleRepository
    ) {
        $this->professeurRepository = $professeurRepository;
        $this->classeRepository = $classeRepository;
        $this->moduleRepository = $moduleRepository;
    }
    
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $cours = new Cours();

            $refProfesseur = rand(0, 3);
            $professeur = $this->getReference("Professeur" . $refProfesseur);

            $refClasse = rand(1, 10); // Assurez-vous que vous avez créé au moins 10 classes
            $classe = $this->classeRepository->find($refClasse);

            if ($classe) {
                $refModule = rand(0, 4);
                $module = $this->moduleRepository->find($refModule);
                
                $cours->setNombreHeureEffAt(new \DateTimeImmutable())
                    ->setNombreHeureGlobalAt(new \DateTimeImmutable())
                    ->setNombreHeurePlannifierAt(new \DateTimeImmutable())
                    ->setProfesseur($professeur)
                    ->addClasse($classe)
                    ->setModule($module);
    
                $manager->persist($cours);
                $this->addReference("Cours" . $i, $cours);
            }
        }

        $manager->flush();
    }
    
    public function getDependencies()
    {
        return array(
            ProfesseurFixtures::class,
            ClasseFixtures::class,
            ModuleFixtures::class,
        );
    }
}
