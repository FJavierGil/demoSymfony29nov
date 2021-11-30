<?php

namespace App\Controller;

use App\Entity\ReferenciaLibro;
use App\Form\ReferenciaLibroType;
use App\Repository\ReferenciaLibroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/referencia/libro')]
class ReferenciaLibroController extends AbstractController
{
    #[Route('/', name: 'referencia_libro_index', methods: ['GET'])]
    public function index(ReferenciaLibroRepository $referenciaLibroRepository): Response
    {
        return $this->render('referencia_libro/index.html.twig', [
            'referencia_libros' => $referenciaLibroRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'referencia_libro_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $referenciaLibro = new ReferenciaLibro();
        $form = $this->createForm(ReferenciaLibroType::class, $referenciaLibro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($referenciaLibro);
            $entityManager->flush();

            return $this->redirectToRoute('referencia_libro_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('referencia_libro/new.html.twig', [
            'referencia_libro' => $referenciaLibro,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'referencia_libro_show', methods: ['GET'])]
    public function show(ReferenciaLibro $referenciaLibro): Response
    {
        return $this->render('referencia_libro/show.html.twig', [
            'referencia_libro' => $referenciaLibro,
        ]);
    }

    #[Route('/{id}/edit', name: 'referencia_libro_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReferenciaLibro $referenciaLibro, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReferenciaLibroType::class, $referenciaLibro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('referencia_libro_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('referencia_libro/edit.html.twig', [
            'referencia_libro' => $referenciaLibro,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'referencia_libro_delete', methods: ['POST'])]
    public function delete(Request $request, ReferenciaLibro $referenciaLibro, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$referenciaLibro->getId(), $request->request->get('_token'))) {
            $entityManager->remove($referenciaLibro);
            $entityManager->flush();
        }

        return $this->redirectToRoute('referencia_libro_index', [], Response::HTTP_SEE_OTHER);
    }
}
