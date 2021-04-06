<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank(message="El email no puede estar vacio")
     * @Assert\NotNull(message="El email no puede ser null")
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @Assert\NotBlank(message="El password no puede estar vacio")
     * @Assert\NotNull(message="El password no puede ser null")
     * @var string The hashed password
     * @ORM\Column(type="string")
     * 
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\NotBlank(message="El nombre no puede estar vacio")
     * @Assert\NotNull(message="El nombre no puede ser null")
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity=ClienteSector::class, mappedBy="id_user")
     */
    private $clienteSectors;


    public function __construct()
    {
        $this->clienteSectors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
            $clienteSector->setIdUser($this);
        }

        return $this;
    }

    public function removeClienteSector(ClienteSector $clienteSector): self
    {
        if ($this->clienteSectors->removeElement($clienteSector)) {
            // set the owning side to null (unless already changed)
            if ($clienteSector->getIdUser() === $this) {
                $clienteSector->setIdUser(null);
            }
        }

        return $this;
    }

}
