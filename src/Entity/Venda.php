<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VendaRepository")
 */
class Venda
{
    CONST STATUS_ANDAMENTO  = "ANDAMENTO";
    CONST STATUS_COMFIRMADO = "CONFIRMADO";

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $ValorTotal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VendaProduto", mappedBy="Venda", orphanRemoval=true)
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

    public function getValorTotal(): ?float
    {
        return $this->ValorTotal;
    }

    public function setValorTotal(float $ValorTotal): self
    {
        $this->ValorTotal = $ValorTotal;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(string $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function inProgress()
    {
        return $this->getStatus() == static::STATUS_ANDAMENTO;
    }

    public function isConfirmed()
    {
        return $this->getStatus() == static::STATUS_COMFIRMADO;
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
            $vendaProduto->setVenda($this);
        }

        return $this;
    }

    public function removeVendaProduto(VendaProduto $vendaProduto): self
    {
        if ($this->vendaProdutos->contains($vendaProduto)) {
            $this->vendaProdutos->removeElement($vendaProduto);
            // set the owning side to null (unless already changed)
            if ($vendaProduto->getVenda() === $this) {
                $vendaProduto->setVenda(null);
            }
        }

        return $this;
    }
}
