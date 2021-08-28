<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BrandRepository::class)
 */
class Brand
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $brandName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $brandDescription;

    /**
     * @ORM\OneToMany(targetEntity=Laptop::class, mappedBy="brand")
     */
    private $lapBrand;

    /**
     * @ORM\OneToMany(targetEntity=Tablet::class, mappedBy="brand")
     */
    private $tabBrand;

    public function __construct()
    {
        $this->lapBrand = new ArrayCollection();
        $this->tabBrand = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrandName(): ?string
    {
        return $this->brandName;
    }

    public function setBrandName(string $brandName): self
    {
        $this->brandName = $brandName;

        return $this;
    }

    public function getBrandDescription(): ?string
    {
        return $this->brandDescription;
    }

    public function setBrandDescription(string $brandDescription): self
    {
        $this->brandDescription = $brandDescription;

        return $this;
    }

    /**
     * @return Collection|Laptop[]
     */
    public function getLapBrand(): Collection
    {
        return $this->lapBrand;
    }

    public function addLapBrand(Laptop $lapBrand): self
    {
        if (!$this->lapBrand->contains($lapBrand)) {
            $this->lapBrand[] = $lapBrand;
            $lapBrand->setBrand($this);
        }

        return $this;
    }

    public function removeLapBrand(Laptop $lapBrand): self
    {
        if ($this->lapBrand->removeElement($lapBrand)) {
            // set the owning side to null (unless already changed)
            if ($lapBrand->getBrand() === $this) {
                $lapBrand->setBrand(null);
            }
        }

        return $this;
    }
    public function __toString() 
    {
        return (string) $this->brandName; 
    }

    /**
     * @return Collection|Tablet[]
     */
    public function getTabBrand(): Collection
    {
        return $this->tabBrand;
    }

    public function addTabBrand(Tablet $tabBrand): self
    {
        if (!$this->tabBrand->contains($tabBrand)) {
            $this->tabBrand[] = $tabBrand;
            $tabBrand->setBrand($this);
        }

        return $this;
    }

    public function removeTabBrand(Tablet $tabBrand): self
    {
        if ($this->tabBrand->removeElement($tabBrand)) {
            // set the owning side to null (unless already changed)
            if ($tabBrand->getBrand() === $this) {
                $tabBrand->setBrand(null);
            }
        }
        return $this;
    }
}
