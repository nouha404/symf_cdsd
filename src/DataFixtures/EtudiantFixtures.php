<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EtudiantFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordHasherInterface $encoder){
        $this->encoder=$encoder;
    }
    
    public function load(ObjectManager $manager): void
    {
        $plainPassword = 'passer@123';
        for ($i = 1; $i <=10; $i++) {
            $user = new Etudiant(

            );
            $user->setNomComplet('Nom et Prenom'.$i);

            $encoded = $this->encoder->hashPassword($user,
            $plainPassword);
            $user->setEmail("etudiant".$i."@gmail.com");
            $user->setPassword($encoded);

            $date = new \DateTimeImmutable("2005-01-01");
            $newDate = $date->add(new \DateInterval("P10D"));
            $user->setDateNaissanceAt($newDate);
            
            
            $user->setTuteur("Tuteur ".$i);
            $user->setMatricule("0000"+$i);
            $manager->persist($user);
            $this->addReference("Etudiant".$i, $user);
        }
        $manager->flush();
    }
}
