<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use App\Entity\Traits\CommonDate;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Repository\ProdutosRepository;

#[ORM\Entity(repositoryClass: ProdutosRepository::class)]
//A ApiResource serve para vermos no Swagger ou na api no navegador
#[ApiResource(
    //leitura global da tabela
    normalizationContext:['groups' => ['produtos_read']],
)]
#[GetCollection()]
#[Get(
    normalizationContext:['groups' => ['produtos_read']],
)]
#[Post(
    //leitura especifica de um method
    normalizationContext:['groups' => ['produtos_read']],
    denormalizationContext:['groups' => ['produtos_write']],
    // inputFormats: ['multipart' => ['multipart/form-data']],

)]
#[Put(
    denormalizationContext:['groups' => ['produtos_read']],
    normalizationContext:['groups' => ['produtos_write ']],
)]
#[Patch()]
#[Delete()]
#[HasLifecycleCallbacks]
#[ApiFilter(
    SearchFilter::class, 
    properties:[
        'valor'  => 'partial',
        // 'valor'  => 'exact',
        // 'categorias' => 'partial',
    ]
)]
#[ApiFilter(DateFilter::class, properties:['dataProduto' => DateFilter:: INCLUDE_NULL_BEFORE_AND_AFTER])]
//Versao Global de order
#[ApiFilter(OrderFilter::class, properties:['id' => 'DESC', 'nome' => 'DESC'])]

class Produtos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 55, nullable: true)]
    #[Assert\NotBlank]
    #[Groups(['produtos_read', 'produtos_write'])]
    private ?string $nome = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        min : 3,
        max : 55,
        minMessage:'minimo de mensagem {{limit}} letras',
        maxMessage:'maximo de mensagem {{limit}} letras'
    )]
    #[Groups(['produtos_read', 'produtos_write'])]
    private ?string $descricao = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    #[Assert\NotBlank]
    #[Groups(['produtos_read', 'produtos_write'])]
    private ?string $valor = null;

    #[ORM\Column(nullable: true)]
    // #[Assert\NotBlank]
    #[Groups(['produtos_read', 'produtos_write'])]
    private ?\DateTimeImmutable $dataProduto = null;

    #[ORM\Column]
    private ?int $userId = null;

    #[ORM\OneToMany(mappedBy: 'categoriaP', targetEntity: Categoria::class)]
    #[Groups(['produtos_read', 'produtos_write'])]
    private Collection $categorias;

    public function __construct()
    {
        $this->categorias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(?string $valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    public function getDataProduto(): ?\DateTimeImmutable
    {
        return $this->dataProduto;
    }

    public function setdataProduto(?\DateTimeImmutable $dataProduto): self
    {
        $this->dataProduto = $dataProduto;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return Collection<int, Categoria>
     */
    public function getCategorias(): Collection
    {
        return $this->categorias;
    }

    public function addCategoria(Categoria $categoria): self
    {
        if (!$this->categorias->contains($categoria)) {
            $this->categorias->add($categoria);
            $categoria->setCategoriaP($this);
        }

        return $this;
    }

    public function removeCategoria(Categoria $categoria): self
    {
        if ($this->categorias->removeElement($categoria)) {
            // set the owning side to null (unless already changed)
            if ($categoria->getCategoriaP() === $this) {
                $categoria->setCategoriaP(null);
            }
        }

        return $this;
    }
  
}
