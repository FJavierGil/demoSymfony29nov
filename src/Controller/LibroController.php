<?php

namespace App\Controller;

use App\Entity\Libro;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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

        return ($libros)
            ? new JsonResponse($libros)
            : $this->errorResponse(404);;
    }

    /**
     * @Route(
     *     path="/{id}",
     *     methods={ "GET" },
     *     name="get"
     * )
     *
     * @param Libro|null $libro
     * @return JsonResponse
     */
    public function mostrarLibro(?Libro $libro): JsonResponse
    {
        // $libro = $this->entityManager
        //     ->getRepository(Libro::class)
        //     ->find($id);
        return ($libro)
            ? new JsonResponse($libro)
            : $this->errorResponse(Response::HTTP_NOT_FOUND);   // 404
    }

    protected function errorResponse(int $statusCode): JsonResponse
    {
        $data = [
            'code' => $statusCode,
            'message' => Response::$statusTexts[$statusCode]
        ];

        return new JsonResponse($data, $statusCode);
    }
}