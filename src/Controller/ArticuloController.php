<?php

namespace App\Controller;

use App\Entity\Articulo;
use App\Form\ArticuloType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ArticuloRepository;

class ArticuloController extends AbstractController
{

    #[Route('/nuevo', name: 'formArticulo')]
    public function formulario(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $articulo = new Articulo();
        $form = $this->createForm(ArticuloType::class, $articulo);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Recogemos la info del formulario
            $articulo = $form->getData();

            // Guardamos la información en la bbdd
            $entityManager->persist($articulo);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }
        
        return $this->renderForm('formulario.html.twig', [
            'form' => $form,
            'mensaje' => 'Agregando nuevo artículo'
        ]);
    }

    #[Route('/eliminar/{id}', name: 'eliminar')]
    public function eliminar(Request $request, ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        //Buscamos por id
        $articulo = $entityManager->getRepository(Articulo::class)->find($id);
        //Borramos el articulo encontrado
        $entityManager->remove($articulo);
        $entityManager->flush();

        return $this->redirectToRoute('index');
        
    }

    #[Route('/editar/{id}', name: 'editar')]
    public function actualizar(Request $request, ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $articulo = $entityManager->getRepository(Articulo::class)->find($id);

        $form = $this->createForm(ArticuloType::class, $articulo);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Recogemos la info del formulario
            $articulo = $form->getData();

            // Guardamos la información en la bbdd
            $entityManager->persist($articulo);
            $entityManager->flush();

            return $this->redirectToRoute('mostrarArticulo', ['id' => $id]);
        }
        
        return $this->renderForm('formularioEditar.html.twig', [
            'form' => $form,
            'mensaje' => 'Editando',
            'id' => $id
        ]);
        
    }

    #[Route('/', name: 'index')]
    public function listarTodos(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        //Listamos todos los articulos
        $articulos = $entityManager->getRepository(Articulo::class)->findAll();
        
        return $this->renderForm('index.html.twig', [
            'articulos' => $articulos,
        ]);
        
    }

    #[Route('/filtrar/{filtro}', name: 'filtrar')]
    public function buscarCat(Request $request, ManagerRegistry $doctrine, String $filtro): Response
    {
        $entityManager = $doctrine->getManager();
        //Hacemos uso del método definido en el Repository para filtrar por categoria
        $articulos = $entityManager->getRepository(Articulo::class)->buscarPorCategoria($filtro);

        
        return $this->renderForm('index.html.twig', [
            'articulos' => $articulos,
        ]);
        
    }

    #[Route('/articulo/{id}', name: 'mostrarArticulo')]
    public function mostrarArticulo(Request $request, ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $articulo = $entityManager->getRepository(Articulo::class)->find($id);

        
        return $this->renderForm('verArticulo.html.twig', [
            'articulo' => $articulo,
        ]);
        
    }

}
