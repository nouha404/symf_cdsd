<?php

namespace App\Controller;

use App\Entity\Plannification;
use App\Form\PlannificationType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\PlannificationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlannificationController extends AbstractController
{
    #[Route('/plannification', name: 'app_plannification')]
    public function index(
        Request $request,
        EntityManagerInterface $manager,
    ): Response
    {

        $plannification = new Plannification;
        
        $form = $this->createForm(PlannificationType::class,$plannification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
    
            $manager->persist($plannification);
            $manager->flush();

            return $this->redirectToRoute('liste_plannification');
        }
        

        return $this->render('plannification/form.index.twig', [
            "form"=>$form->createView(),
        ]);
    }

    #[Route('/liste-planning', name: 'liste_plannification',methods:["GET","POST"])]
    public function listerCours(
        Request $request,
        PlannificationRepository $plannificationRepository,
        PaginatorInterface $paginator,
    ): Response
    {
        $plannifications = $plannificationRepository->findAll();

        $pagination = $paginator->paginate(
            $plannifications, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            2 /*limit per page*/
        );

        return $this->render('plannification/index.html.twig', [
            
            'pagination' => $pagination
            /*
            'semestres' => $semestres,
            'professeurs' => $professeurs,
            'classes' => $classes,
            */
        ]);
    }
}
