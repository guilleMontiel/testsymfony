<?php

namespace App\Entity;

use App\Repository\EmpresaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraint as Assert;
/**
 * @ORM\Entity(repositoryClass=EmpresaRepository::class)
 */
class Empresa
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @NotBlank("El campo nombre no puede estar vacio.")
     * @NotNull("El Nombre no puede ser nulo.")
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=Sector::class, inversedBy="empresas")
     * @NotNull("Debe elegir un Sector para la Empresa.")
     */
    private $sector;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSector(): ?Sector
    {
        return $this->sector;
    }

    public function setSector(?Sector $sector): self
    {
        $this->sector = $sector;

        return $this;
    }
}
