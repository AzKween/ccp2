<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SiteRepository::class)
 */
class Site
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
    private $Title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $HomePicture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $MenPicture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $WomenPicture;

    /**
     * @ORM\Column(type="text")
     */
    private $HomeBlog;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getHomePicture(): ?string
    {
        return $this->HomePicture;
    }

    public function setHomePicture(string $HomePicture): self
    {
        $this->HomePicture = $HomePicture;

        return $this;
    }

    public function getMenPicture(): ?string
    {
        return $this->MenPicture;
    }

    public function setMenPicture(string $MenPicture): self
    {
        $this->MenPicture = $MenPicture;

        return $this;
    }

    public function getWomenPicture(): ?string
    {
        return $this->WomenPicture;
    }

    public function setWomenPicture(string $WomenPicture): self
    {
        $this->WomenPicture = $WomenPicture;

        return $this;
    }

    public function getHomeBlog(): ?string
    {
        return $this->HomeBlog;
    }

    public function setHomeBlog(string $HomeBlog): self
    {
        $this->HomeBlog = $HomeBlog;

        return $this;
    }
}
