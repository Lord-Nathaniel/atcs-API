<?php

namespace App\Entity;

use App\Repository\PermanenceRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=PermanenceRepository::class)
 * @ApiResource(
 * normalizationContext={"groups"={"read:permanence","read:evenement","read:type"}},
 * collectionOperations={"get"},
 * itemOperations={"get"})
 */
class Permanence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:permanence"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read:permanence"})
     */
    private $semaine;

    /**
     * @ORM\Column(type="date_immutable")     * 
     * @Groups({"read:permanence"})
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="Permanences")
     * @Groups({"read:permanence"})
     */
    private $Type;

    /**
     * @ORM\ManyToOne(targetEntity=Evenement::class, inversedBy="Permanences")
     * @Groups({"read:permanence"})
     */
    private $Evenement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSemaine(): ?int
    {
        return $this->semaine;
    }

    public function setSemaine(int $semaine): self
    {
        $this->semaine = $semaine;

        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->Type;
    }

    public function setType(?Type $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getEvenement(): ?Evenement
    {
        return $this->Evenement;
    }

    public function setEvenement(?Evenement $Evenement): self
    {
        $this->Evenement = $Evenement;

        return $this;
    }
}
