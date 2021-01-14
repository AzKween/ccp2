<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticlesRepository::class)
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
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\ManyToMany(targetEntity=Cart::class, mappedBy="Relation_Articles")
     */
    private $carts;

    /**
     * @ORM\ManyToMany(targetEntity=Kinds::class, inversedBy="articles")
     */
    private $Relation_Kinds;

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
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection|Cart[]
     */
    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function addCart(Cart $cart): self
    {
        if (!$this->carts->contains($cart)) {
            $this->carts[] = $cart;
            $cart->addRelationArticle($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        if ($this->carts->removeElement($cart)) {
            $cart->removeRelationArticle($this);
        }

        return $this;
    }

    /**
     * @return Collection|Kinds[]
     */
    public function getRelationKinds(): Collection
    {
        return $this->Relation_Kinds;
    }

    public function addRelationKind(Kinds $relationKind): self
    {
        if (!$this->Relation_Kinds->contains($relationKind)) {
            $this->Relation_Kinds[] = $relationKind;
        }

        return $this;
    }

    public function removeRelationKind(Kinds $relationKind): self
    {
        $this->Relation_Kinds->removeElement($relationKind);

        return $this;
    }
}
