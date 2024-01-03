<?php
namespace App\Controller;

use App\Repository\AnneScolaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/', name: 'app_login')]
    public function login(
        AuthenticationUtils $authenticationUtils, 
        AnneScolaireRepository $anneScolaireRepository, 
        SessionInterface $session

        ): Response
    {
        if ($this->getUser()) {
            $annees =$anneScolaireRepository->findAll();
            $anneEnCour =$anneScolaireRepository->findOneBy([
                "isActive"=>true
            ]);

            $session->set("annees", $annees);
            $session->set("anneEnCour", $anneEnCour);

            $user = $this->getUser();
            //si role == AC
            if(in_array("ROLE_ETUDIANT",$user->getRoles())){
                return $this->redirectToRoute('app_classe');
            }
            elseif(in_array("ROLE_PROFESSEUR",$user->getRoles())){ 
                return $this->redirectToRoute('app_professeur');
            }elseif(in_array("ROLE_AC",$user->getRoles())){ 
                return $this->redirectToRoute('liste_cours');
            }
            elseif(in_array("ROLE_RP",$user->getRoles())){ 
                return $this->redirectToRoute('liste_cours');
            }
             
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        //$this->redirectToRoute('app_login');
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
        
    }
}
