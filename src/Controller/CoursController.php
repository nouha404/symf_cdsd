<?php

namespace App\Controller;

use App\Entity\Cours;
use DateTimeImmutable;
use App\Form\CoursType;
use App\Entity\CoursTrue;
use App\Form\FiltreClasseType;
use App\Form\FiltreSemestreType;
use App\Form\FiltreProfesseurType;
use App\Repository\ClasseRepository;
use App\Repository\ModuleRepository;
use App\Repository\SemestreRepository;
use App\Repository\CoursTrueRepository;
use App\Repository\ProfesseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AnneScolaireRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;

class CoursController extends AbstractController
{
    #[Route('/add-cours', name: 'app_cours')]
    public function index(
        Request $request,
        EntityManagerInterface $manager,
        ProfesseurRepository $professeurRepository,
        SemestreRepository $semestreRepository,
        ModuleRepository $moduleRepository,
        AnneScolaireRepository $anneScolaireRepository
    ): Response
    {
        $cours = new CoursTrue;
        
        $form = $this->createForm(CoursType::class,$cours);
        $form->handleRequest($request);
        
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            
            $nombreHeureEffAt = $data->getNombreHeureEffAt();
            $nombreHeurePlannifierAt = $data->getNombreHeurePlannifierAt();
            $nombreHeureGlobalAt = $data->getNombreHeureGlobalAt();
            
            $professeur = $professeurRepository->find($cours->getProfesseur()->getId());
            $semestre = $semestreRepository->find($cours->getSemestre()->getId());
            $module = $moduleRepository->find($cours->getModule()->getId());
           
            $anneeScolaire = $anneScolaireRepository->findOneBy(['isActive' => true]);

            $cours->setProfesseur($professeur);
            $cours->setSemestre($semestre);
            $cours->setModule($module);
            $cours->setAnneScolaire($anneeScolaire);
            
            $cours->setNombreHeureEffAt($nombreHeureEffAt);
            $cours->setNombreHeurePlannifierAt($nombreHeurePlannifierAt);
            $cours->setNombreHeureGlobalAt($nombreHeureGlobalAt);

            $manager->persist($cours);
            $manager->flush();

            return $this->redirectToRoute('liste_cours');


        }

        return $this->render('cours/form.index.html.twig', [
            "form"=>$form->createView(),
        ]);
    }

    #[Route('/cours', name: 'liste_cours',methods:["GET","POST"])]
    public function listerCours(
        Request $request,
        CoursTrueRepository $coursRepository,
        SemestreRepository $semestreRepository, 
        ProfesseurRepository $professeurRepository,
        ClasseRepository $classeRepository,
        PaginatorInterface $paginator,
    ): Response
    {

        $form = $this->createForm(FiltreSemestreType::class);
        $formProf = $this->createForm(FiltreProfesseurType::class);
        $formClasse= $this->createForm(FiltreClasseType::class);

        $form->handleRequest($request);
        $formProf->handleRequest($request);
        $formClasse->handleRequest($request);

        
        $filtres= [];


        if($form->isSubmitted()){
            if($form->get("semestre")->getData()!=null){
                $filtres["semestre"] = $form->get("semestre")->getData();
             }
             /*if($form->get("professeur")->getData()!=null){
                 $filtres["professeur"] = $form->get("professeur")->getData();
             }

            if($form->get("classe")->getData()!=null){
                $filtres["classe"] = $form->get("classe")->getData();
               
            }*/
            
            //dd($filtres);
        }elseif($formProf->isSubmitted()){
            if($formProf->get("professeur")->getData()!=null){
                    $filtres["professeur"] = $formProf->get("professeur")->getData();
                }

        }
        /*
        PROBLEME AVEC CLASSE
        elseif($formClasse->isSubmitted()){
            if($formClasse->get("classe")->getData()!=null){
                $filtres["classe"] = $formClasse->get("classe")->getData();
                $libelle = $formClasse->get("classe")->getData()->getNomClasse();

                $test = $coursRepository->findAll();

                
            }

            dd($test);
            //$classeData = $formClasse->get("classe")->getData();

            //$libelle = $classeData->getNomClasse();
            
            //$test = $coursRepository->findBy(["classe" => $libelle]);
            //dd($test);
        }*/
       

        

      
        $coursList = $coursRepository->findBy($filtres);

        $pagination = $paginator->paginate(
            $coursList, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );

        return $this->render('cours/index.html.twig', [
            'coursList' => $coursList,
            'form'=>$form->createView(),
            'formProf'=>$formProf->createView(),
            'formClasse'=>$formClasse->createView(),
            'pagination' => $pagination
            /*
            'semestres' => $semestres,
            'professeurs' => $professeurs,
            'classes' => $classes,
            */
        ]);
    }


    
}
