<?php

namespace App\Tests\Entity;

use App\Entity\ReferenciaLibro;
use App\Entity\Libro;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Entity\Libro
 */
class LibroTest extends TestCase
{
    protected Libro $libro;

    protected function setUp(): void
    {
        $this->libro = new Libro();
    }

    /**
     * @covers ::__construct()
     */
    public function test__construct()
    {
        $miLibro = new Libro();
        self::assertSame(0, $miLibro->getId());
        self::assertNull($miLibro->getAutor());
        self::assertNull($miLibro->getNumPaginas());
        self::assertEmpty($miLibro->getReferenciaLibros());
    }

    /**
     * @covers ::getId()
     */
    public function testGetId()
    {
        self::assertEquals(
            0,
            $this->libro->getId()
        );
    }

    /**
     * @covers ::setTitulo()
     * @covers ::getTitulo()
     */
    public function testGetSetTitulo()
    {
        $titulo = '´Ññ!"·$%/&/()=?¿áÁûÙ';
        $this->libro->setTitulo($titulo);
        self::assertSame(
            $titulo,
            $this->libro->getTitulo()
        );
    }

    /**
     * @covers ::getAutor()
     * @covers ::setAutor()
     */
    public function testGetSetAutor()
    {
        $autor = 'ñÑ´{}`**+[]!"·$%&/()=?¿¡';
        $this->libro->setAutor($autor);
        self::assertSame(
            $autor,
            $this->libro->getAutor()
        );
    }

    /**
     * @covers ::setNumPaginas
     * @covers ::getNumPaginas
     */
    public function testGetSetNumPaginas()
    {
        $num = random_int(1, 1000);
        $this->libro->setNumPaginas($num);
        self::assertSame(
            $num,
            $this->libro->getNumPaginas()
        );
    }

    /**
     * @covers ::__toString()
     */
    public function test__toString()
    {
        $titulo = '|@#~€¬€abcñÑáöÓçÇ*';
        $this->libro->setTitulo($titulo);
        self::assertSame(
            $titulo,
            $this->libro->__toString()
        );

    }

    /**
     * @covers ::jsonSerialize()
     */
    public function testJsonSerialize()
    {
        self::assertJson(json_encode($this->libro));
    }

    /**
     * @covers ::addReferenciaLibro
     * @covers ::removeReferenciaLibro
     */
    public function testAddRemoveReferenciaLibro(): Libro
    {
        $referenciaLibro = new ReferenciaLibro();
        // add
        $this->libro->addReferenciaLibro($referenciaLibro);
        self::assertContains(
            $referenciaLibro,
            $this->libro->getReferenciaLibros()
        );
        // remove
        $this->libro->removeReferenciaLibro($referenciaLibro);
        self::assertNotContains(
            $referenciaLibro,
            $this->libro->getReferenciaLibros()
        );

        return $this->libro;
    }

    /**
     * @depends testAddRemoveReferenciaLibro
     *
     * @covers ::getReferenciaLibros
     * @param Libro $libro
     */
    public function testGetCriticaLibros(Libro $libro)
    {
        self::assertSame(
            0,
            $libro->getReferenciaLibros()->count()
        );
    }
}
