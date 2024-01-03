<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ExceptionController extends AbstractController
{
    #[Route('/exception', name: 'app_exception')]
    public function index(
        \Throwable $exception
    ): Response
    {

        $statusCode = $exception instanceof HttpExceptionInterface ? $exception->getStatusCode() : 500;

        if ($exception instanceof AccessDeniedException) {
            // Affiche la page d'erreur 403 personnalisée
            return $this->render('error/403.html.twig', ['status_code' => $statusCode]);
        }



        return $this->render('error/error.html.twig', [
            'status_code' => $statusCode,
        ]);
    }
}
