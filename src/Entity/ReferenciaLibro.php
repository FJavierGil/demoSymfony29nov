<?php

namespace App\Entity;

use App\Repository\ReferenciaLibroRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReferenciaLibroRepository::class)
 * @ORM\Table(name="referencias")
 */
class ReferenciaLibro implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $url;

    /**
     * @ORM\ManyToOne(targetEntity=Libro::class, inversedBy="referenciaLibros")
     * @ORM\JoinColumn(nullable=false)
     */
    private Libro $libro;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getLibro(): Libro
    {
        return $this->libro;
    }

    public function setLibro(Libro $libro): self
    {
        $this->libro = $libro;

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
            'url' => $this->getUrl(),
            'id_libro' => $this->getLibro()->getId(),
        ];
    }
}
