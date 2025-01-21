<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['users.show'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['users.show','users.create','users.log'])]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Groups(['users.show','users.create', 'users.log'])]
    private ?string $mdp = null;

    #[ORM\Column(length: 255)]
    #[Groups(['users.show','users.create'])]
    private ?string $nom = null;

    /**
     * @var Collection<int, Licenses>
     */
    #[ORM\OneToMany(targetEntity: Licenses::class, mappedBy: 'idUser')]
    private Collection $licenses;

    /**
     * @var Collection<int, IpRight>
     */
    #[ORM\OneToMany(targetEntity: IpRight::class, mappedBy: 'idUser')]
    private Collection $ipRights;

    public function __construct()
    {
        $this->licenses = new ArrayCollection();
        $this->ipRights = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): static
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Licenses>
     */
    public function getLicenses(): Collection
    {
        return $this->licenses;
    }

    public function addLicense(Licenses $license): static
    {
        if (!$this->licenses->contains($license)) {
            $this->licenses->add($license);
            $license->setIdUser($this);
        }

        return $this;
    }

    public function removeLicense(Licenses $license): static
    {
        if ($this->licenses->removeElement($license)) {
            // set the owning side to null (unless already changed)
            if ($license->getIdUser() === $this) {
                $license->setIdUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, IpRight>
     */
    public function getIpRights(): Collection
    {
        return $this->ipRights;
    }

    public function addIpRight(IpRight $ipRight): static
    {
        if (!$this->ipRights->contains($ipRight)) {
            $this->ipRights->add($ipRight);
            $ipRight->setIdUser($this);
        }

        return $this;
    }

    public function removeIpRight(IpRight $ipRight): static
    {
        if ($this->ipRights->removeElement($ipRight)) {
            // set the owning side to null (unless already changed)
            if ($ipRight->getIdUser() === $this) {
                $ipRight->setIdUser(null);
            }
        }

        return $this;
    }
}
