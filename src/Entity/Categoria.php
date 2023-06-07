<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategoriaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategoriaRepository::class)]
#[ApiResource]
class Categoria
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['produtos_read'])]
    private ?string $categoria = null;

    #[ORM\ManyToOne(inversedBy: 'categorias')]
    private ?Produtos $categoriaP = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getCategoriaP(): ?Produtos
    {
        return $this->categoriaP;
    }

    public function setCategoriaP(?Produtos $categoriaP): self
    {
        $this->categoriaP = $categoriaP;

        return $this;
    }
}
