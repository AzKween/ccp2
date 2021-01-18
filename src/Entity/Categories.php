<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
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
    private $Category;

    /**
     * @ORM\OneToMany(targetEntity=Articles::class, mappedBy="categories")
     */
    private $Relation_Articles;

    public function __construct()
    {
        $this->Relation_Articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->Category;
    }

    public function setCategory(string $Category): self
    {
        $this->Category = $Category;

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
            $relationArticle->setCategories($this);
        }

        return $this;
    }

    public function removeRelationArticle(Articles $relationArticle): self
    {
        if ($this->Relation_Articles->removeElement($relationArticle)) {
            // set the owning side to null (unless already changed)
            if ($relationArticle->getCategories() === $this) {
                $relationArticle->setCategories(null);
            }
        }

        return $this;
    }
}
