<?php

namespace App\DataFixtures;

use App\Entity\Libro;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LibroFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $libro1 = new Libro();
        $libro1->setTitulo('Título 1');
        $manager->persist($libro1);

        $libro2 = new Libro();
        $libro2->setTitulo('Título 2');
        $manager->persist($libro2);
        
        $manager->flush();
    }
}
