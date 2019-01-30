<?php

namespace App\Entity;

use App\Controller\ProdutoController;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProdutoRepository")
 * @Gedmo\SoftDeleteable(fieldName="data_esxclusao", timeAware=false, hardDelete=true)
 */
class Produto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descricao;

    /**
     * @ORM\Column(type="float")
     */
    private $preco;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codigo;

    /**
    @ORM\Column(name="data_exclusao", type="datetime", nullable=true)
     */
    private $DataExclusao;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VendaProduto", mappedBy="Produto")
     */
    private $vendaProdutos;

    public function __construct()
    {
        $this->vendaProdutos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getPreco(): ?float
    {
        return $this->preco;
    }

    public function setPreco(float $preco): self
    {
        $this->preco = $preco;

        return $this;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getDataExclusao(): ?\DateTimeInterface
    {
        return $this->DataExclusao;
    }

    public function setDataExclusao(\DateTimeInterface $DataExclusao): self
    {
        $this->DataExclusao = $DataExclusao;

        return $this;
    }

    /**
     * @return Collection|VendaProduto[]
     */
    public function getVendaProdutos(): Collection
    {
        return $this->vendaProdutos;
    }

    public function addVendaProduto(VendaProduto $vendaProduto): self
    {
        if (!$this->vendaProdutos->contains($vendaProduto)) {
            $this->vendaProdutos[] = $vendaProduto;
            $vendaProduto->setProduto($this);
        }

        return $this;
    }

    public function removeVendaProduto(VendaProduto $vendaProduto): self
    {
        if ($this->vendaProdutos->contains($vendaProduto)) {
            $this->vendaProdutos->removeElement($vendaProduto);
            // set the owning side to null (unless already changed)
            if ($vendaProduto->getProduto() === $this) {
                $vendaProduto->setProduto(null);
            }
        }

        return $this;
    }
}
