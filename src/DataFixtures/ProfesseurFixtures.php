<?php

namespace App\DataFixtures;

use App\Entity\Professeur;
use App\Repository\GradeRepository;
use Doctrine\Persistence\ObjectManager;
use App\Repository\ProfesseurRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfesseurFixtures extends Fixture
{
    private GradeRepository $gradeRepository;

    private $encoder;
    public function __construct(UserPasswordHasherInterface $encoder,GradeRepository $gradeRepository)
    {
        $this->encoder=$encoder;
        $this->gradeRepository = $gradeRepository;
        
    }


    public function load(ObjectManager $manager): void
    {
        $datas = [
            [
                "nomComplet" => "Baila Wane",
                "email" => "4keus@gmail.com",
                "isArchived" => false
            ],
            [
                "nomComplet" => "Djiby Niang",
                "email" => "8keus@gmail.com",
                "isArchived" => false
            ],
            [
                "nomComplet" => "Issa Sow",
                "email" => "16keus@gmail.com",
                "isArchived" => false
            ],
            [
                "nomComplet" => "Lamine Kane",
                "email" => "32keus@gmail.com",
                "isArchived" => false
            ],
            [
                "nomComplet" => "Grazoamine Kane",
                "email" => "300P2keus@gmail.com",
                "isArchived" => false
            ],
            [
                "nomComplet" => "MyoeLamine Kane",
                "email" => "woy32keus@gmail.com",
                "isArchived" => false
            ],
            [
                "nomComplet" => "Samba allar Kane",
                "email" => "Sam32keus@gmail.com",
                "isArchived" => false
            ],
            [
                "nomComplet" => "IbadiLamine Kane",
                "email" => "0432keus@gmail.com",
                "isArchived" => false
            ],
            [
                "nomComplet" => "Brahiamine Kane",
                "email" => "332keus3@gmail.com",
                "isArchived" => false
            ],
            [
                "nomComplet" => "Lamine Kane33",
                "email" => "324keus@gmail.com",
                "isArchived" => false
            ]
        ];
        $plainPassword = 'passer@123';
        foreach ($datas as $i => $profData) { 
            $professeur = new Professeur();

            $professeur->setNomComplet($profData["nomComplet"]);
            $professeur->setIsArchived(false);
            $professeur->setEmail($profData["email"]);

            $encoded = $this->encoder->hashPassword($professeur, $plainPassword);
            $professeur->setPassword($encoded);

            
            $manager->persist($professeur);//insertion
            $this->addReference("Professeur".$i,$professeur);
        }
        

        $manager->flush();
    }
}
