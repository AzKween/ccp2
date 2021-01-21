<?php

namespace App\Entity;

use DateTime;
use App\Entity\Cart;
use App\Entity\Kinds;
use App\Entity\Categories;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * @ORM\Entity(repositoryClass=ArticlesRepository::class)
 * @Vich\Uploadable()
 */
class Articles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="float")
     */
    private $Price;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $Picture;

    /**
     * @var File|null
     * @Assert\Image(mimeTypes={"image/jpeg", "image/jpg", "image/png"})
     * @Vich\UploadableField(mapping="upload", fileNameProperty="picture")
     *
     */
    private $PictureFile;

    /**
     * @ORM\ManyToMany(targetEntity=Cart::class, mappedBy="Relation_Articles")
     */
    private $carts;


    /**
     * @ORM\Column(type="datetime")
     * @var null|DateTime
     */
    private $updated_at;


    /**
     * @ORM\ManyToOne(targetEntity=Kinds::class, inversedBy="articles")
     */
    private $Relation_kinds;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="Relation_Articles")
     */
    private $categories;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateAdd;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->carts = new ArrayCollection();
        $this->Relation_Kinds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->Picture;
    }

    public function setPicture(?string $Picture): self
    {
        $this->Picture = $Picture;

        return $this;
    }


    public function getPictureFile()
    {
        return $this->PictureFile;
    }

    public function setPictureFile( ?File $PictureFile ): void {
        $this->PictureFile = $PictureFile;
        if($this->PictureFile instanceof UploadedFile){
            $this->updated_at = new \DateTime('now');
        }
        //return $this;
    }


    public function getRelationKinds(): ?Kinds
    {
        return $this->Relation_kinds;
    }

    public function setRelationKinds( ?Kinds $Relation_kinds): self
    {
        $this->Relation_kinds = $Relation_kinds;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getDateAdd(): ?\DateTimeInterface
    {
        return $this->DateAdd;
    }

    public function setDateAdd(\DateTimeInterface $DateAdd): self
    {
        $this->DateAdd = $DateAdd;

        return $this;
    }
}
