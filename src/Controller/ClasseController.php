<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClasseType;
use App\Form\SeachFormClassType;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasseController extends AbstractController
{    
    //uri ou path        
    #[Route('/classe', name: 'app_classe',methods:["GET","POST"])]
    public function index(Request $request,ClasseRepository $classeRepository, PaginatorInterface $paginator): Response
    {
       

        $form = $this->createForm(SeachFormClassType::class);
        $form->handleRequest($request);
        //le filtre: c'est un objet
        $filtres= [
            'isArchived'=>false
        ];
        
        if($form->isSubmitted()){
            //recuperer l'objet et testé si c'est difereent de null
            if($form->get("niveau")->getData()!=null){
               //ajouter le niveau dans le filtre
               $filtres["niveau"] = $form->get("niveau")->getData();
            }
            if($form->get("filiere")->getData()!=null){
                $filtres["filiere"] = $form->get("filiere")->getData();
            }
        }

        $classes=$classeRepository->findBy($filtres);
        //pagination
        $pagination = $paginator->paginate(
            $classes, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );


        
        return $this->render('classe/index.html.twig', [
            "classesNotArchived" => $classes,
            "form"=>$form->createView(),
            'pagination' => $pagination
        ]);
    }

    #[Route('/classe/save/{id?}', name: 'app_classe_save',methods:["GET","POST"])]
    public function saveAndUpdate($id,Request $request, EntityManagerInterface $manager,ClasseRepository $classeRepository): Response
    {

        if($id== null){
            $classe = new Classe();
        } else {
            $classe = $classeRepository->find($id);
        }

        
        //creation du formulaire et le mapper a l'objet classe
        $form = $this->createForm(ClasseType::class,$classe);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($classe);
            $manager->flush();
        }

        return $this->render('classe/form.index.twig', [
            "form"=>$form->createView()
          
        ]);
    }
}
