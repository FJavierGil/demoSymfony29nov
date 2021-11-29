<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class SaludoController
{

    public function saluda(): Response
    {
        return new Response('Mi primera página con Symfony');
    }
}