<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 * @ApiResource(
 * normalizationContext={"groups"={"read:type"}},
 * collectionOperations={"get"},
 * itemOperations={"get"})
 */
class Type
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:type"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:type"})
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Permanence::class, mappedBy="Type")
     */
    private $Permanences;

    public function __construct()
    {
        $this->Permanences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Permanence[]
     */
    public function getPermanences(): Collection
    {
        return $this->Permanences;
    }

    public function addPermanence(Permanence $permanence): self
    {
        if (!$this->Permanences->contains($permanence)) {
            $this->Permanences[] = $permanence;
            $permanence->setType($this);
        }

        return $this;
    }

    public function removePermanence(Permanence $permanence): self
    {
        if ($this->Permanences->removeElement($permanence)) {
            // set the owning side to null (unless already changed)
            if ($permanence->getType() === $this) {
                $permanence->setType(null);
            }
        }

        return $this;
    }
}
