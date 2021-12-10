<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VehicleRepository::class)
 */
class Vehicle
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
     * @ORM\Column(type="string", length=255)
     */
    private string $brand;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $model;

    /**
     * @ORM\Column(type="smallint")
     */
    private int $productYear;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     */
    private string $usedHour;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string|null $idMotorbox;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getProductYear(): int
    {
        return $this->productYear;
    }

    public function setProductYear(int $productYear): self
    {
        $this->productYear = $productYear;

        return $this;
    }

    public function getUsedHour(): ?string
    {
        return $this->usedHour;
    }

    public function setUsedHour(string $usedHour): self
    {
        $this->usedHour = $usedHour;

        return $this;
    }

    public function getIdMotorbox(): ?string
    {
        return $this->idMotorbox;
    }

    public function setIdMotorbox(?string $idMotorbox): self
    {
        $this->idMotorbox = $idMotorbox;

        return $this;
    }
}
