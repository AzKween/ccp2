<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Json;

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
     * @ORM\Column(type="json")
     */
    private $Articles = [];

    /**
     * @ORM\Column(type="float")
     */
    private $Total;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $Relation_User;

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

    public function getArticles(): array
    {
        return $this->Articles;
    }

    public function setArticles(array $Articles): self
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

    public function getRelationUser(): ?User
    {
        return $this->Relation_User;
    }

    public function setRelationUser(?User $Relation_User): self
    {
        $this->Relation_User = $Relation_User;

        return $this;
    }
}
