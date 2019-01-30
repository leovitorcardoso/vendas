<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VendaProdutoRepository")
 */
class VendaProduto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Venda", inversedBy="vendaProdutos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Venda;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produto", inversedBy="vendaProdutos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Produto;

    /**
     * @ORM\Column(type="integer")
     */
    private $Quantidade;

    /**
     * @ORM\Column(type="float")
     */
    private $ValorUnitario;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVenda(): ?Venda
    {
        return $this->Venda;
    }

    public function setVenda(?Venda $Venda): self
    {
        $this->Venda = $Venda;

        return $this;
    }

    public function getProduto(): ?Produto
    {
        return $this->Produto;
    }

    public function setProduto(?Produto $Produto): self
    {
        $this->Produto = $Produto;

        return $this;
    }

    public function getQuantidade(): ?int
    {
        return $this->Quantidade;
    }

    public function setQuantidade(int $Quantidade): self
    {
        $this->Quantidade = $Quantidade;

        return $this;
    }

    public function getValorUnitario(): ?float
    {
        return $this->ValorUnitario;
    }

    public function setValorUnitario(float $ValorUnitario): self
    {
        $this->ValorUnitario = $ValorUnitario;

        return $this;
    }

    public function getValorTotal()
    {
        return $this->getValorUnitario() * $this->getQuantidade();
    }
}
