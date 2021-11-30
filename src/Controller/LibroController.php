<?php

namespace App\Controller;

use App\Entity\Libro;
use App\Form\LibroType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/libro')]
class LibroController extends AbstractController
{
    #[Route('/', name: 'libro_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $libros = $entityManager
            ->getRepository(Libro::class)
            ->findAll();

        return $this->render(
            'libro/index.html.twig',
            [
                'libros' => $libros,
            ]
        );
    }

    #[Route('/new', name: 'libro_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $libro = new Libro();
        $form = $this->createForm(LibroType::class, $libro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($libro);
            $entityManager->flush();

            return $this->redirectToRoute('libro_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('libro/new.html.twig', [
            'libro' => $libro,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'libro_show', methods: ['GET'])]
    public function show(Libro $libro): Response
    {
        return $this->render('libro/show.html.twig', [
            'libro' => $libro,
        ]);
    }

    #[Route('/{id}/edit', name: 'libro_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Libro $libro, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LibroType::class, $libro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('libro_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('libro/edit.html.twig', [
            'libro' => $libro,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'libro_delete', methods: ['POST'])]
    public function delete(Request $request, Libro $libro, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$libro->getId(), $request->request->get('_token'))) {
            $entityManager->remove($libro);
            $entityManager->flush();
        }

        return $this->redirectToRoute('libro_index', [], Response::HTTP_SEE_OTHER);
    }
}
