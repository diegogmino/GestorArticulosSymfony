<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticuloController extends AbstractController
{
    #[Route('/articulo', name: 'articulo')]
    public function index(): Response
    {
        return $this->render('articulo/index.html.twig', [
            'controller_name' => 'ArticuloController',
        ]);
    }

}
