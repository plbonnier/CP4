<?php

namespace App\Entity;

use App\Repository\OrangOutanRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OrangOutanRepository::class)]
#[Vich\Uploadable]
class OrangOutan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birth = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $story = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[Vich\UploadableField(mapping: 'picture_file', fileNameProperty: 'picture')]
    #[Assert\File(
        maxSize: '2M',
        mimeTypes: ['image/jpeg', 'image/png', 'image/webp'],
    )]
    private ?File $pictureFile = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'adopt')]
    private Collection $adoptParents;
    #[ORM\OneToMany(mappedBy: 'orangoutan', targetEntity: Adopt::class, orphanRemoval: true)]
    private Collection $adopts;
    public function __construct()
    {
        $this->adoptParents = new ArrayCollection();
        $this->adopts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBirth(): ?\DateTimeInterface
    {
        return $this->birth;
    }

    public function setBirth(\DateTimeInterface $birth): static
    {
        $this->birth = $birth;

        return $this;
    }

    public function getStory(): ?string
    {
        return $this->story;
    }

    public function setStory(?string $story): static
    {
        $this->story = $story;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;
        return $this;
    }

    public function setPictureFile(File $image = null): OrangOutan
    {
        $this->pictureFile = $image;
        if ($image) {
            $this->updatedAt = new DateTime('now');
        }
        return $this;
    }

    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getAdoptParents(): Collection
    {
        return $this->adoptParents;
    }

    public function addAdoptParent(User $adoptParent): static
    {
        if (!$this->adoptParents->contains($adoptParent)) {
            $this->adoptParents->add($adoptParent);
            $adoptParent->addAdopt($this);
        }

        return $this;
    }

    public function removeAdoptParent(User $adoptParent): static
    {
        if ($this->adoptParents->removeElement($adoptParent)) {
            $adoptParent->removeAdopt($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Adopt>
     */
    public function getAdopts(): Collection
    {
        return $this->adopts;
    }

    public function addAdopt(Adopt $adopt): static
    {
        if (!$this->adopts->contains($adopt)) {
            $this->adopts->add($adopt);
            $adopt->setOrangoutan($this);
        }

        return $this;
    }

    public function removeAdopt(Adopt $adopt): static
    {
        if ($this->adopts->removeElement($adopt)) {
// set the owning side to null (unless already changed)
            if ($adopt->getOrangoutan() === $this) {
                $adopt->setOrangoutan(null);
            }
        }

        return $this;
    }
}
