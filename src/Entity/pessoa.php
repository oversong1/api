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

 *     normalizationContext  ={"groups"={"pessoa_read"}},
 *     denormalizationContext={"groups"={"pessoa_write"}},
 *     collectionOperations  ={
 *          "get"              ={
 *            "access_control"="is_granted('ROLE_CLIENT')",
 *            "path"          ="/pessoa",
 *          },
 *     },
 *     itemOperations        ={
 *         "get"           ={
 *           "access_control"="is_granted('ROLE_CLIENT')",
 *           "path"          ="/pessoa/{idpessoa}",
 *         },
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\pessoaRepository")
 * @ORM\Table(name="pessoa")
 */
class pessoa
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="text",name="idPessoa")
     */
    private $idPessoa;

    /**
     * @ORM\Column(type="string", length=50, nullable=false,name="nome")
     * @Groups({"pessoa_read"}))
     */
    private $nome;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=false,name="idade")
     * @Groups({"pessoa_read"}))
     */
    private $idade;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=false,name="sexo")
     * @Groups({"pessoa_read"}))
     */
    private $sexo;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=false,name="profissao")
     * @Groups({"pessoa_read"}))
     */
    private $profissao;



    /**
     * Get the value of idPessoa
     */
    public function getIdPessoa()
    {
        return $this->idPessoa;
    }

    /**
     * Set the value of idPessoa
     */
    public function setIdPessoa($idPessoa): self
    {
        $this->idPessoa = $idPessoa;

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
     * Get the value of idade
     */
    public function getIdade()
    {
        return $this->idade;
    }

    /**
     * Set the value of idade
     */
    public function setIdade($idade): self
    {
        $this->idade = $idade;

        return $this;
    }

    /**
     * Get the value of sexo
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set the value of sexo
     */
    public function setSexo($sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get the value of profissao
     */
    public function getProfissao()
    {
        return $this->profissao;
    }

    /**
     * Set the value of profissao
     */
    public function setProfissao($profissao): self
    {
        $this->profissao = $profissao;

        return $this;
    }
}
