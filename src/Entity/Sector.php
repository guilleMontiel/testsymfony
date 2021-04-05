<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\SectorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SectorRepository::class)
 */
class Sector
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="El nombre no puede estar vacio")
     * @Assert\NotNull(message="El nombre no puede ser null")
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity=Empresa::class, mappedBy="sector")
     */
    private $empresas;

    /**
     * @ORM\OneToMany(targetEntity=ClienteSector::class, mappedBy="id_sector")
     */
    private $clienteSectors;


    public function __construct()
    {
        $this->empresas = new ArrayCollection();
        $this->clienteSectors = new ArrayCollection();
    }

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

    /**
     * @return Collection|Empresa[]
     */
    public function getEmpresas(): Collection
    {
        return $this->empresas;
    }

    public function addEmpresa(Empresa $empresa): self
    {
        if (!$this->empresas->contains($empresa)) {
            $this->empresas[] = $empresa;
            $empresa->setSector($this);
        }

        return $this;
    }

    public function removeEmpresa(Empresa $empresa): self
    {
        if ($this->empresas->removeElement($empresa)) {
            // set the owning side to null (unless already changed)
            if ($empresa->getSector() === $this) {
                $empresa->setSector(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ClienteSector[]
     */
    public function getClienteSectors(): Collection
    {
        return $this->clienteSectors;
    }

    public function addClienteSector(ClienteSector $clienteSector): self
    {
        if (!$this->clienteSectors->contains($clienteSector)) {
            $this->clienteSectors[] = $clienteSector;
            $clienteSector->setIdSector($this);
        }

        return $this;
    }

    public function removeClienteSector(ClienteSector $clienteSector): self
    {
        if ($this->clienteSectors->removeElement($clienteSector)) {
            // set the owning side to null (unless already changed)
            if ($clienteSector->getIdSector() === $this) {
                $clienteSector->setIdSector(null);
            }
        }

        return $this;
    }

   
   
}
