<?php

namespace App\Entity;

use App\Repository\IpRightRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: IpRightRepository::class)]
class IpRight
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['ipRight.show'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['ipRight.create','ipRight.show'])]
    private ?string $type = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['ipRight.create','ipRight.show'])]
    private ?\DateTimeInterface $dateDepot = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['ipRight.create','ipRight.show'])]
    private ?\DateTimeInterface $dateExpiration = null;

    #[ORM\Column(length: 255)]
    #[Groups(['ipRight.create','ipRight.show'])]
    private ?string $territoire = null;

    /**
     * @var Collection<int, Deadlines>
     */
    #[ORM\OneToMany(targetEntity: Deadlines::class, mappedBy: 'idIpRight')]
    #[Groups(['ipRight.show'])]
    private Collection $deadlines;

    /**
     * @var Collection<int, Litiges>
     */
    #[ORM\OneToMany(targetEntity: Litiges::class, mappedBy: 'idIpRight')]
    #[Groups(['ipRight.show'])]
    private Collection $litiges;

    #[ORM\ManyToOne(inversedBy: 'ipRights')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['ipRight.show'])]
    private ?User $idUser = null;

    public function __construct()
    {
        $this->deadlines = new ArrayCollection();
        $this->litiges = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDateDepot(): ?\DateTimeInterface
    {
        return $this->dateDepot;
    }

    public function setDateDepot(\DateTimeInterface $dateDepot): static
    {
        $this->dateDepot = $dateDepot;

        return $this;
    }

    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->dateExpiration;
    }

    public function setDateExpiration(\DateTimeInterface $dateExpiration): static
    {
        $this->dateExpiration = $dateExpiration;

        return $this;
    }

    public function getTerritoire(): ?string
    {
        return $this->territoire;
    }

    public function setTerritoire(string $territoire): static
    {
        $this->territoire = $territoire;

        return $this;
    }

    /**
     * @return Collection<int, Deadlines>
     */
    public function getDeadlines(): Collection
    {
        return $this->deadlines;
    }

    public function addDeadline(Deadlines $deadline): static
    {
        if (!$this->deadlines->contains($deadline)) {
            $this->deadlines->add($deadline);
            $deadline->setIdIpRight($this);
        }

        return $this;
    }

    public function removeDeadline(Deadlines $deadline): static
    {
        if ($this->deadlines->removeElement($deadline)) {
            // set the owning side to null (unless already changed)
            if ($deadline->getIdIpRight() === $this) {
                $deadline->setIdIpRight(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Litiges>
     */
    public function getLitiges(): Collection
    {
        return $this->litiges;
    }

    public function addLitige(Litiges $litige): static
    {
        if (!$this->litiges->contains($litige)) {
            $this->litiges->add($litige);
            $litige->setIdIpRight($this);
        }

        return $this;
    }

    public function removeLitige(Litiges $litige): static
    {
        if ($this->litiges->removeElement($litige)) {
            // set the owning side to null (unless already changed)
            if ($litige->getIdIpRight() === $this) {
                $litige->setIdIpRight(null);
            }
        }

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }
}
