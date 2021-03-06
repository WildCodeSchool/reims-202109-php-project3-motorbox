<?php

namespace App\Entity;

use App\Repository\PartRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PartRepository::class)
 */
class Part
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="integer")
     */
    private int $lifespan;

    /**
     * @ORM\ManyToOne(targetEntity=Vehicle::class, inversedBy="parts")
     * @ORM\JoinColumn(nullable=false)
     */
    private Vehicle $vehicle;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     */
    private string $partUseTime;

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

    public function getLifespan(): ?int
    {
        return $this->lifespan;
    }

    public function setLifespan(int $lifespan): self
    {
        $this->lifespan = $lifespan;

        return $this;
    }

    public function getVehicle(): Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(Vehicle $vehicle): self
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    public function getPartUseTime(): ?string
    {
        return $this->partUseTime;
    }

    public function setPartUseTime(string $partUseTime): self
    {
        $this->partUseTime = $partUseTime;

        return $this;
    }
}
