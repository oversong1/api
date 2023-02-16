<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Id\AbstractIdGenerator;

/**
* @ApiResource(

 *     normalizationContext  ={"groups"={"produto_read"}},
 *     denormalizationContext={"groups"={"produto__write"}},
 *     collectionOperations  ={
 *          "get"              ={
 *            "access_control"="is_granted('ROLE_CLIENT')",
 *            "path"          ="/produto",
 *          },
 *     },
 *     itemOperations        ={
 *         "get"           ={
 *           "access_control"="is_granted('ROLE_CLIENT')",
 *           "path"          ="/produto/{idProduto}",
 *         },
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\produtoRepository")
 * @ORM\Table(name="produto")
 */
class produto
{

    /**
     * @ORM\Id
     * @ORM\Column(type="text",name="idProduto")
     */
    private $idProduto;

    /**
     * @ORM\Column(type="string", length=50, nullable=false,name="nome")
     * @Groups({"produto_read"}))
     */
    private $nome;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=false,name="valor")
     * @Groups({"produto_read"}))
     */
    private $valor;
   
    /**
     * @ORM\Column(type="string", length=50, nullable=false,name="descricao")
     * @Groups({"produto_read"}))
     */
    private $descricao;



    /**
     * Get the value of idProduto
     */
    public function getIdProduto()
    {
        return $this->idProduto;
    }

    /**
     * Set the value of idProduto
     */
    public function setIdProduto($idProduto): self
    {
        $this->idProduto = $idProduto;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome($nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of valor
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set the value of valor
     */
    public function setValor($valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get the value of descricao
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     */
    public function setDescricao($descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }
}
