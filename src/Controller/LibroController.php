<?php

namespace App\Controller;

use App\Entity\Libro;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     path="/libros",
 *     name="miw_libros_"
 * )
 */
class LibroController extends AbstractController
{
    private EntityManager $entityManager;

    public function __construct(EntityManagerInterface $em)
    {
        $this->entityManager = $em;
    }

    /**
     * @Route(
     *     path="/list",
     *     name="list",
     *     methods={ "GET" }
     *     )
     *
     * @return JsonResponse
     */
    public function listLibros(): JsonResponse
    {
        $libros = $this->entityManager
            ->getRepository(Libro::class)
            ->findAll();

        return new JsonResponse($libros);
    }

    /**
     * @Route(
     *     path="/{id}",
     *     methods={ "GET" },
     *     name="get"
     * )
     *
     * @param Libro $libro
     * @return JsonResponse
     */
    public function mostrarLibro(Libro $libro): JsonResponse
    {
        // $libro = $this->entityManager
        //     ->getRepository(Libro::class)
        //     ->find($id);
        return new JsonResponse($libro);
    }
}