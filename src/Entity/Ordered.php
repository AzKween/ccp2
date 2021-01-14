<?php

namespace App\Entity;

use App\Repository\OrderedRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderedRepository::class)
 */
class Ordered
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $Articles;

    /**
     * @ORM\Column(type="float")
     */
    private $Total;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\Column(type="integer")
     */
    private $Num_Ordered;

    /**
     * @ORM\Column(type="text")
     */
    private $Delivery_Address;

    /**
     * @ORM\Column(type="text")
     */
    private $Billing_Address;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="relation")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Cart::class, inversedBy="ordereds")
     */
    private $Relation_Cart;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getNumOrdered(): ?int
    {
        return $this->Num_Ordered;
    }

    public function setNumOrdered(int $Num_Ordered): self
    {
        $this->Num_Ordered = $Num_Ordered;

        return $this;
    }

    public function getDeliveryAddress(): ?string
    {
        return $this->Delivery_Address;
    }

    public function setDeliveryAddress(string $Delivery_Address): self
    {
        $this->Delivery_Address = $Delivery_Address;

        return $this;
    }

    public function getBillingAddress(): ?string
    {
        return $this->Billing_Address;
    }

    public function setBillingAddress(string $Billing_Address): self
    {
        $this->Billing_Address = $Billing_Address;

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

    public function getRelationCart(): ?Cart
    {
        return $this->Relation_Cart;
    }

    public function setRelationCart(?Cart $Relation_Cart): self
    {
        $this->Relation_Cart = $Relation_Cart;

        return $this;
    }
}
