<?php

namespace App\DataFixtures;

use App\Entity\Semestre;
use App\Repository\NiveauRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SemestreFixtures extends Fixture implements DependentFixtureInterface
{
    private NiveauRepository $niveauRepository;

    public function __construct(NiveauRepository $niveauRepository)
    {
        $this->niveauRepository = $niveauRepository;
    }
    public function load(ObjectManager $manager): void
    {
        
        $datas = ["Semestre 1", "Semestre 2","Semestre 3", "Semestre 4"];
        for ($i = 0; $i < count($datas); $i++) {
            $semestre = new Semestre();

            $refNiveau = rand(0, 2);
            $niveau = $this->niveauRepository->find($refNiveau);

            $semestre->setLibelle($datas[$i])
                ->setNiveau($niveau);

            $manager->persist($semestre);
            $this->addReference("Semestre" . $i, $semestre);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            NiveauFixtures::class,
        );
    }

}
