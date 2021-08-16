<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 * @ApiResource(
 * normalizationContext={"groups"={"read:evenement"}})
 */
class Evenement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:evenement"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:evenement"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:evenement"})
     */
    private $etat;

    /**
     * @ORM\OneToMany(targetEntity=Permanence::class, mappedBy="Evenement")
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

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

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
            $permanence->setEvenement($this);
        }

        return $this;
    }

    public function removePermanence(Permanence $permanence): self
    {
        if ($this->Permanences->removeElement($permanence)) {
            // set the owning side to null (unless already changed)
            if ($permanence->getEvenement() === $this) {
                $permanence->setEvenement(null);
            }
        }

        return $this;
    }
}
