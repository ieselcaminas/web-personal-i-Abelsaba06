<?php

namespace App\Entity;

use App\Repository\EmpresaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: EmpresaRepository::class)]
class Empresa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "El nombre es obligatorio")]
    private ?string $nombre = null;

    #[ORM\Column]
        #[Assert\PositiveOrZero(message: "El numero de trabajadores no puede ser negativo.")]
    private int $numeroTrabajadores;

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

    public function getNumeroTrabajadores(): int
{
    return $this->numeroTrabajadores;
}

public function setNumeroTrabajadores(int $numeroTrabajadores): self
{
    $this->numeroTrabajadores = $numeroTrabajadores;
    return $this;
}
}
