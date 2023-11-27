<?php
namespace App\Controller;
use App\Entity\Professeur;
use App\Form\ProfesseurType;
use App\Repository\ModuleRepository;
use App\Form\SearchFormProfesseurType;
use App\Repository\ProfesseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfesseurController extends AbstractController
{
     //uri ou path        
     #[Route('/professeur', name: 'app_professeur',methods:["GET","POST"])]
     public function index(
        Request $request,
        ProfesseurRepository $professeurRepository,
        PaginatorInterface $paginator
        ): Response
     {
 
        $form = $this->createForm(SearchFormProfesseurType::class);
        $form->handleRequest($request);
        
         
        $grades=[];
        $classes=[];
      
        
         if($form->isSubmitted()){

            $grades = $form->get("grade")->getData();
            $classes = $form->get("classe")->getData();
            if (!empty($grades) ) {
                // Ajouter le niveau dans le filtre
                $professeurs = $professeurRepository->findByFilters($grades);
            } elseif($classes){
                $professeurs = $professeurRepository->findBy(['classe' => $classes]);
            }
            else {
                // Si aucun grade n'est sélectionné, vous pouvez récupérer tous les professeurs
                $professeurs = $professeurRepository->findAll();
            }
            
            
          
        }


        $professeurs = $professeurRepository->findByFilters($grades);
        
        //gerer le cas ou grade et classes sont vides
        /*if(empty($grades) && empty($classe)){
            $professeurs = $professeurRepository->findAll();
        }*/
        
        
         //pagination
         // Avant le retour dans votre méthode index

         $pagination = $paginator->paginate(
             $professeurs, /* query NOT result */
             $request->query->getInt('page', 1), /*page number*/
             5 /*limit per page*/
         );
         
         
         return $this->render('professeur/index.html.twig', [
             "ProfesseurNotArchived" => $professeurs,
             "form"=>$form->createView(),
             'pagination' => $pagination
         ]);
         
     }
    
    


    //route insert et update
   #[Route('/professeur/save/{id?}', name: 'app_professeur_save',methods:["GET","POST"])]
    public function saveAndUpdate($id,Request $request, EntityManagerInterface $manager,ProfesseurRepository $professeurRepository): Response
    {

        $professeur = $professeurRepository->find($id);
        
        
        if($id== null){
            $professeur = new Professeur();
        } 
        

        //creation du formulaire et le mapper a l'objet classe
        $form = $this->createForm(ProfesseurType::class,$professeur);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // Supprimer les grades existants avant de les ajouter
            $professeur->getGrade();

            foreach ($form->get('grade')->getData() as $grade) {
                $professeur->addGrade($grade);
            }

            $manager->persist($professeur);
            $manager->flush();

        }
        

        return $this->render('professeur/form.index.twig', [
            "form"=>$form->createView(),
        ]);
    }
    
}
