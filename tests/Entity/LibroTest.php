<?php

namespace App\Tests\Entity;

use App\Entity\Libro;
use PHPUnit\Framework\TestCase;

class LibroTest extends TestCase
{
    protected Libro $libro;

    protected function setUp(): void
    {
        $this->libro = new Libro();
    }

    public function testAddReferenciaLibro()
    {

    }

    public function testGetSetTitulo()
    {
        $titulo = '´Ññ!"·$%/&/()=?¿áÁûÙ';
        $this->libro->setTitulo($titulo);
        self::assertSame(
            $titulo,
            $this->libro->getTitulo()
        );
    }

    public function testSetNumPaginas()
    {

    }

    public function testSetAutor()
    {

    }

    public function test__toString()
    {

    }

    public function testGetReferenciaLibros()
    {

    }

    public function testGetAutor()
    {

    }

    public function testGetId()
    {

    }

    public function testJsonSerialize()
    {

    }

    public function testGetNumPaginas()
    {

    }

    public function testRemoveReferenciaLibro()
    {

    }

    public function test__construct()
    {

    }
}
