<?php

namespace App\Entity;

use App\Repository\LikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikeRepository::class)]
#[ORM\Table(name: '`like`')]
class Like
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'likes')]
    private ?Shoes $shoes = null;

    #[ORM\ManyToOne(inversedBy: 'likes')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShoes(): ?Shoes
    {
        return $this->shoes;
    }

    public function setShoes(?Shoes $shoes): self
    {
        $this->shoes = $shoes;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
