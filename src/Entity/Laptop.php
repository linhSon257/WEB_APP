<?php

namespace App\Entity;

use App\Repository\LaptopRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LaptopRepository::class)
 */
class Laptop
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Size::class, inversedBy="lapSize")
     * @ORM\JoinColumn(nullable=false)
     */
    private $size;

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="lapBrand")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $color;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $madein;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $priceDiscount;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSize(): ?Size
    {
        return $this->size;
    }

    public function setSize(?Size $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getMadein(): ?string
    {
        return $this->madein;
    }

    public function setMadein(string $madein): self
    {
        $this->madein = $madein;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPriceDiscount(): ?int
    {
        return $this->priceDiscount;
    }

    public function setPriceDiscount(int $priceDiscount): self
    {
        $this->priceDiscount = $priceDiscount;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }
}
