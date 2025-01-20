<?php

namespace App\Entity;

use App\Repository\DeadlinesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DeadlinesRepository::class)]
class Deadlines
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['deadlines.show'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'deadlines')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['deadlines.show','deadlines.create'])]
    private ?IpRight $idIpRight = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['deadlines.show','deadlines.create'])]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    #[Groups(['deadlines.show','deadlines.create'])]
    private ?string $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdIpRight(): ?IpRight
    {
        return $this->idIpRight;
    }

    public function setIdIpRight(?IpRight $idIpRight): static
    {
        $this->idIpRight = $idIpRight;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

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
}
