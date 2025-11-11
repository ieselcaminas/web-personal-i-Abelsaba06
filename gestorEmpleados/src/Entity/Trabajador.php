<?php

namespace App\Entity;

use App\Repository\TrabajadorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TrabajadorRepository::class)]
class Trabajador
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[Assert\NotBlank(message: "El nombre es obligatorio")]
    #[ORM\Column(length: 255)]
    private ?string $nombre = null;
    #[Assert\NotBlank(message: "El telefono es obligatorio")]
    #[ORM\Column(length: 255)]
    private ?string $telefono = null;

    #[ORM\Column]
       #[Assert\PositiveOrZero(message: "La edad no puede ser negativa.")]
    private ?int $edad = null;

    #[ORM\Column(length: 255)]
    private ?string $cotizacion = null;

    #[ORM\Column(length: 255, nullable: true)]
        #[Assert\PositiveOrZero(message: "El salario no puede ser negativo.")]
    private ?int $salario = null;

    #[ORM\Column(length: 255)]
    private ?string $puesto = null;

    #[ORM\ManyToOne(inversedBy: 'trabajadors')]
    private ?Empresa $empresa = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(int $edad): static
    {
        $this->edad = $edad;

        return $this;
    }

    public function getCotizacion(): ?string
    {
        return $this->cotizacion;
    }

    public function setCotizacion(string $cotizacion): static
    {
        $this->cotizacion = $cotizacion;

        return $this;
    }

    public function getSalario(): ?int
    {
        return $this->salario;
    }

    public function setSalario(?int $salario): static
    {
        $this->salario = $salario;

        return $this;
    }

    public function getPuesto(): ?string
    {
        return $this->puesto;
    }

    public function setPuesto(string $puesto): static
    {
        $this->puesto = $puesto;

        return $this;
    }

    public function getEmpresa(): ?Empresa
    {
        return $this->empresa;
    }

    public function setEmpresa(?Empresa $empresa): static
    {
        $this->empresa = $empresa;

        return $this;
    }
}
