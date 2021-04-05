<?php

namespace App\Entity;

use App\Repository\ClienteSectorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClienteSectorRepository::class)
 */
class ClienteSector
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="clienteSectors")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_user;

    /**
     * @ORM\ManyToOne(targetEntity=Sector::class, inversedBy="clienteSectors")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_sector;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getIdSector(): ?Sector
    {
        return $this->id_sector;
    }

    public function setIdSector(?Sector $id_sector): self
    {
        $this->id_sector = $id_sector;

        return $this;
    }
}
