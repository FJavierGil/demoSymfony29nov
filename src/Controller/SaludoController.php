<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SaludoController
{

    /**
     * @Route(
     *     path="/hola",
     *     name="ruta_saluda",
     *     methods={ "GET", "HEAD" }
     * )
     */
    public function saluda(): Response
    {
        return new Response('Mi primera página con Symfony');
    }

    /**
     * @Route(
     *     path="/saluda/{nombre}",
     *     name="saludo_personalizado"
     * )
     * @param string $nombre
     * @return Response
     */
    public function saluda2(string $nombre='MiW 2021'): Response
    {
        return new Response("Buenos días $nombre!!!");
    }
}