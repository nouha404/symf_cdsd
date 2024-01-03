<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Entity\Inscription;
use App\Form\NEWCLASSEType;
use App\Form\InscriptionType;
use App\Form\ReinscriptionType;
use App\Repository\ClasseRepository;
use App\Repository\NiveauRepository;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\InscriptionRepository;
use Symfony\Component\Form\FormInterface;
use App\Repository\AnneScolaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class InscriptionController extends AbstractController
{
    private $encoder;
    public function __construct(UserPasswordHasherInterface $encoder){
        $this->encoder=$encoder;
        
    }
    //la nouvelle formulaire
    private function createNewClasseForm(): FormInterface
    {
        return $this->createForm(NEWCLASSEType::class, new Classe());
    }


    
    #[Route('/inscription', name: 'app_inscription')]
    public function index(
        Request $request,
        InscriptionRepository $inscriptionRepository,
        ClasseRepository $classeRepository, 
        SessionInterface $session,
        AnneScolaireRepository $anneScolaireRepository, 
        ): Response
    {
        #recupere les info avec le button
        if($request->request->has("btn-changed")){
            $idAnneeChanged = $request->request->get("annee");

            $anneEnCour =$anneScolaireRepository->find(["id"=>$idAnneeChanged]);
            #ajout de la nouvelle annee selection 
            $session->set("anneEnCour", $anneEnCour);

        }
        $anneEnCour=$session->get("anneEnCour");
        $inscrits = $inscriptionRepository->findBy([
            "anneScolaire"=>$anneEnCour,
            "isArchived"=>false
        ]
        );
        $classes= $classeRepository->findBy(
            ["isArchived"=>false]
        );
        return $this->render('inscription/index.html.twig', [
            'datas' => $inscrits,
            'classes' => $classes,
        ]);
    }


    #[Route('/inscription/save/', name: 'app_inscription_save',methods:["GET","POST"])]
    public function save(
        Request $request, 
        EntityManagerInterface $manager,
        AnneScolaireRepository $anneScolaireRepository, 

        ): Response
    {
       
        $inscription = new Inscription;
        
        //creation du formulaire et le mapper a l'objet classe
        $form = $this->createForm(InscriptionType::class,$inscription);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $anneEnCour =$anneScolaireRepository->findOneBy([
                "isActive"=>true
            ]);

            $inscription->setAnneScolaire($anneEnCour);
            $inscription->getEtudiant()->setMatricule(uniqid());

            $encoded = $this->encoder->hashPassword(
                $inscription->getEtudiant(),
                $inscription->getEtudiant()->getPassword());

            $inscription->getEtudiant()->setPassword($encoded);

            $manager->persist($inscription);
            $manager->flush();
        }

        return $this->render('inscription/form.index.twig', [
            "form"=>$form->createView()
          
        ]);
    }


    #[Route('/reinscription', name: 'app_professeur_reinscription',methods:["GET","POST"])]
    public function reinscription(
        Request $request, EntityManagerInterface $manager,
        InscriptionRepository $inscriptionRepository,
        AnneScolaireRepository $anneScolaireRepository, 
        EtudiantRepository $etudiantRepository,
        ClasseRepository $classeRepository,
        NiveauRepository $niveauRepository,
    ): Response
    {
        $inscription = new Inscription();
        
        //creation du formulaire et le mapper a l'objet classe
        $form = $this->createForm(ReinscriptionType::class,$inscription);        
        $form->handleRequest($request);

        //nouvelle formulaire pour la classe
        $newClasseForm = $this->createNewClasseForm();
        $newClasseForm->handleRequest($request);
        

        $etudiant = null;
        $ancienneClasse = null;
        $classesNiveau = null;
        $classeSuivant=null;
        $isMatricule = false;

       

        

        

        if ($etudiant && $etudiant->getMatricule() === 'null') {
            $etudiant->setMatricule(null);
        }  

        if($form->isSubmitted() && $form->isValid()){
           
            $matricule = $form->get('matricule')->getData();
            $etudiant = $etudiantRepository->findOneBy(['matricule' => $matricule]);
            
            
            

            if ($etudiant) {
                $existingInscription = $inscriptionRepository->findOneBy([
                    'etudiant' => $etudiant,
                    'isArchived' => false,
                ]);

                
                
                if ($existingInscription) {
                    $isMatricule = true;
                    $ancienneClasseId = $existingInscription->getClasse()->getId();
                    
                    $ancienneClasse = $classeRepository->findOneBy(["id"=>$ancienneClasseId]);
                    
                    //recuperer le niveau 
                    $niveauID = $ancienneClasse->getNiveau()->getId();
                    $niveau = $niveauRepository->findOneBy(["id"=>$niveauID]);

                    //recuperer les classes correspondant
                    $classesNiveau = $classeRepository->findBy(['niveau' => $niveau]);
                    

                    //la classe suivant
                    $niveauIDSuivant = $niveauID + 1;
                    $niveauSuivant = $niveauRepository->findOneBy(["id"=>$niveauIDSuivant]);
                    $classeSuivant = $classeRepository->findBy(['niveau' => $niveauSuivant]);
                    
                   
    
                        // Ajoutez un message flash pour informer de la mise à jour réussie
                        $this->addFlash('success', 'La réinscription a été effectuée avec succès.');
                    
                       
                    
                   
                } else {
                    $nouvelleClasseId = $form->get('classeId')->getData();
                    $nouvelleClasse = $classeRepository->find($nouvelleClasseId);
                    $nouveauNiveau = $nouvelleClasse->getNiveau();

                    $classesNiveau = $classeRepository->findBy(['niveau' => $nouveauNiveau]);
                    
                    $classeSuivant = $classeRepository->findBy(['niveau' => $nouveauNiveau+1]);
                    $inscription->setEtudiant($etudiant);
                    $inscription->getEtudiant()->setMatricule($matricule);
                    $inscription->setAnneScolaire($anneScolaireRepository->findOneBy(['isActive' => true]));
                    $inscription->setClasse($nouvelleClasse);
                    

                    $manager->persist($inscription);
                    $manager->flush();

                   
 
                }
                

                
             

                
                
            }   
            
           


            
          
            
         
        }

        if ($request->request->has("last-btn")) {
          
               
            $classeId = $request->request->get('selection');
            //$classLabel = $classeRepository->findOneBy(["id"=>$classeId])->getNomClasse();
            $objClasse = $classeRepository->find($classeId);
            
            $matricule = $request->request->get("reinscription_matricule");

            $etudiant = $etudiantRepository->findOneBy(['matricule' => $matricule]);
            
            

            if ($etudiant) {
                $existingInscription = $inscriptionRepository->findOneBy([
                    'etudiant' => $etudiant,
                    'isArchived' => false,
                ]);
               
               

                if ($existingInscription) {
                   
                    $existingInscription->setClasse($objClasse);
                    $manager->persist($existingInscription);
                    $manager->flush();

                   return $this->redirectToRoute('app_professeur_reinscription');
                }
            }
          
       
        }

       


        return $this->render('inscription/reform.index.html.twig', [
            "form"=>$form->createView(),
            "newClasseForm" => $newClasseForm->createView(),
            "etudiant" => $etudiant,
            "ancienneClasse" => $ancienneClasse,
            "classesNiveau" => $classesNiveau,
            "classeSuivant"=>$classeSuivant,
            "isMatricule"=>$isMatricule,
            
          
        ]);

        
    }



    // ...

   

       
        
        



}



