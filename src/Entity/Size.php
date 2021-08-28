<?php

namespace App\Entity;

use App\Repository\SizeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SizeRepository::class)
 */
class Size
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
    private $sizeName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sizeDescription;

    /**
     * @ORM\OneToMany(targetEntity=Laptop::class, mappedBy="size")
     */
    private $lapSize;

    public function __construct()
    {
        $this->lapSize = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSizeName(): ?string
    {
        return $this->sizeName;
    }

    public function setSizeName(string $sizeName): self
    {
        $this->sizeName = $sizeName;

        return $this;
    }

    public function getSizeDescription(): ?string
    {
        return $this->sizeDescription;
    }

    public function setSizeDescription(string $sizeDescription): self
    {
        $this->sizeDescription = $sizeDescription;

        return $this;
    }

    /**
     * @return Collection|Laptop[]
     */
    public function getLapSize(): Collection
    {
        return $this->lapSize;
    }

    public function addLapSize(Laptop $lapSize): self
    {
        if (!$this->lapSize->contains($lapSize)) {
            $this->lapSize[] = $lapSize;
            $lapSize->setSize($this);
        }

        return $this;
    }

    public function removeLapSize(Laptop $lapSize): self
    {
        if ($this->lapSize->removeElement($lapSize)) {
            // set the owning side to null (unless already changed)
            if ($lapSize->getSize() === $this) {
                $lapSize->setSize(null);
            }
        }

        return $this;
    }
    public function __toString() 
    {
        return (string) $this->sizeName; 
    }
}
