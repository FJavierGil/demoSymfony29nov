<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private int $id = 0;

    /**
     * @ORM\Column(name="titulo", type="string", length=60, nullable=false)
     */
    private string $titulo = '';

    /**
     * @ORM\Column(name="autor", type="string", length=40, nullable=true)
     */
    private ?string $autor = null;

    /**
     * @ORM\Column(name="num_paginas", type="integer", nullable=true)
     */
    private ?int $numPaginas = null;

    /**
     * @ORM\OneToMany(targetEntity=ReferenciaLibro::class, mappedBy="libro", orphanRemoval=true)
     */
    private Collection $referenciaLibros;

    public function __construct()
    {
        $this->referenciaLibros = new ArrayCollection();
    }

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

    public function __toString(): string
    {
        return $this->getTitulo();
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
            'referencias' => $this->getReferenciaLibros()->toArray(),
        ];
    }

    /**
     * @return Collection|ReferenciaLibro[]
     */
    public function getReferenciaLibros(): Collection
    {
        return $this->referenciaLibros;
    }

    public function addReferenciaLibro(ReferenciaLibro $referenciaLibro): self
    {
        if (!$this->referenciaLibros->contains($referenciaLibro)) {
            $this->referenciaLibros[] = $referenciaLibro;
            $referenciaLibro->setLibro($this);
        }

        return $this;
    }

    public function removeReferenciaLibro(ReferenciaLibro $referenciaLibro): self
    {
        if ($this->referenciaLibros->removeElement($referenciaLibro)) {
            // set the owning side to null (unless already changed)
            if ($referenciaLibro->getLibro() === $this) {
                $referenciaLibro->setLibro(null);
            }
        }

        return $this;
    }
}
