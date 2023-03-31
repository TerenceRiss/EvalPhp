<?php

namespace App\Entity;


use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ShoesRepository;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: ShoesRepository::class)]
class Shoes
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $gender = null;


    #[ORM\Column]
    private ?int $price = null;


    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[Vich\UploadableField(mapping:"shoes", fileNameProperty:"image")]
    private ?File $imageFile = null;

    #[ORM\OneToMany(mappedBy: 'shoes', targetEntity: Like::class, orphanRemoval:true)]
    private Collection $likes;

    #[ORM\OneToMany(mappedBy: 'shoes', targetEntity: Comment::class, orphanRemoval:true, cascade: ['persist'])]
    private Collection $user;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\OrderBy(["size" => "ASC"])]
    #[ORM\OneToMany(mappedBy: 'model', targetEntity: Variant::class, orphanRemoval: true)]
    private Collection $variants;

    public function __construct()
    {
        $this->date = new DateTime();
        $this->likes = new ArrayCollection();
        $this->user = new ArrayCollection();
        $this->variants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }


    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }


    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
   
    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        return $this;
    }

    /**
     * @return Collection<int, Like>
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Like $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes->add($like);
            $like->setShoes($this);
        }

        return $this;
    }

    public function removeLike(Like $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getShoes() === $this) {
                $like->setShoes(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(Comment $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->setShoes($this);
        }

        return $this;
    }

    public function removeUser(Comment $user): self
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getShoes() === $this) {
                $user->setShoes(null);
            }
        }

        return $this;
    }


    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection<int, Variant>
     */
    public function getVariants(): Collection
    {
        return $this->variants;
    }

    public function addVariant(Variant $variant): self
    {
        if (!$this->variants->contains($variant)) {
            $this->variants->add($variant);
            $variant->setModel($this);
        }

        return $this;
    }

    public function removeVariant(Variant $variant): self
    {
        if ($this->variants->removeElement($variant)) {
            // set the owning side to null (unless already changed)
            if ($variant->getModel() === $this) {
                $variant->setModel(null);
            }
        }

        return $this;
    }

    public function getMinSize(): string
    {
        if($this->variants->count() < 1) {
            return '-';
        }
        return $this->variants->first()->getSize();
    }

    public function getMaxSize(): string
    {
        if($this->variants->count() < 1) {
            return '-';
        }
        return $this->variants->last()->getSize();
    }


}
