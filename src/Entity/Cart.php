<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private $Articles;

    /**
     * @ORM\Column(type="float")
     */
    private $Total;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="Relation_Cart")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Ordered::class, mappedBy="Relation_Cart")
     */
    private $ordereds;

    /**
     * @ORM\ManyToMany(targetEntity=Articles::class, inversedBy="carts")
     */
    private $Relation_Articles;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->ordereds = new ArrayCollection();
        $this->Relation_Articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticles(): ?string
    {
        return $this->Articles;
    }

    public function setArticles(string $Articles): self
    {
        $this->Articles = $Articles;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->Total;
    }

    public function setTotal(float $Total): self
    {
        $this->Total = $Total;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setRelationCart($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getRelationCart() === $this) {
                $user->setRelationCart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ordered[]
     */
    public function getOrdereds(): Collection
    {
        return $this->ordereds;
    }

    public function addOrdered(Ordered $ordered): self
    {
        if (!$this->ordereds->contains($ordered)) {
            $this->ordereds[] = $ordered;
            $ordered->setRelationCart($this);
        }

        return $this;
    }

    public function removeOrdered(Ordered $ordered): self
    {
        if ($this->ordereds->removeElement($ordered)) {
            // set the owning side to null (unless already changed)
            if ($ordered->getRelationCart() === $this) {
                $ordered->setRelationCart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Articles[]
     */
    public function getRelationArticles(): Collection
    {
        return $this->Relation_Articles;
    }

    public function addRelationArticle(Articles $relationArticle): self
    {
        if (!$this->Relation_Articles->contains($relationArticle)) {
            $this->Relation_Articles[] = $relationArticle;
        }

        return $this;
    }

    public function removeRelationArticle(Articles $relationArticle): self
    {
        $this->Relation_Articles->removeElement($relationArticle);

        return $this;
    }
}
