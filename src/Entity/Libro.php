<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Libro
 *
 * @ORM\Table(name="libros")
 * @ORM\Entity
 */
class Libro implements \JsonSerializable
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="titulo", type="string", length=60, nullable=false)
     */
    private string $titulo;

    /**
     * @ORM\Column(name="autor", type="string", length=40, nullable=true)
     */
    private ?string $autor;

    /**
     * @ORM\Column(name="num_paginas", type="integer", nullable=true)
     */
    private ?int $numPaginas;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitulo(): string
    {
        return $this->titulo;
    }

    /**
     * @param string $titulo
     * @return Libro
     */
    public function setTitulo(string $titulo): Libro
    {
        $this->titulo = $titulo;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAutor(): ?string
    {
        return $this->autor;
    }

    /**
     * @param string|null $autor
     * @return Libro
     */
    public function setAutor(?string $autor): Libro
    {
        $this->autor = $autor;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNumPaginas(): ?int
    {
        return $this->numPaginas;
    }

    /**
     * @param int|null $numPaginas
     * @return Libro
     */
    public function setNumPaginas(?int $numPaginas): Libro
    {
        $this->numPaginas = $numPaginas;
        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'titulo' => $this->getTitulo(),
            'autor' => $this->getAutor(),
            'numPaginas' => $this->getNumPaginas(),
        ];
    }
}
