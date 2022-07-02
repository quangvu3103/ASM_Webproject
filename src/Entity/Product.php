<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NameProduct;

    /**
     * @ORM\Column(type="integer")
     */
    private $Quantity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Information;

    /**
     * @ORM\Column(type="integer")
     */
    private $Price;


    /**
     * @ORM\ManyToOne(targetEntity=TypeProduct::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeProduct;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameProduct(): ?string
    {
        return $this->NameProduct;
    }

    public function setNameProduct(string $NameProduct): self
    {
        $this->NameProduct = $NameProduct;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getInformation(): ?string
    {
        return $this->Information;
    }

    public function setInformation(string $Information): self
    {
        $this->Information = $Information;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->Price;
    }

    public function setPrice(int $Price): self
    {
        $this->Price = $Price;

        return $this;
    }


    public function getTypeProduct(): ?TypeProduct
    {
        return $this->typeProduct;
    }

    public function setTypeProduct(?TypeProduct $typeProduct): self
    {
        $this->typeProduct = $typeProduct;

        return $this;
    }
}
