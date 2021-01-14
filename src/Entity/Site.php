<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SiteRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=SiteRepository::class)
 * @Vich\Uploadable()
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
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $HomePicture;

    /**
     * @var File|null
     * @Assert\Image(mimeTypes={"image/jpeg", "image/jpg", "image/png"})
     * @Vich\UploadableField(mapping="upload", fileNameProperty="HomePicture")
     *
     */
    private $HomePictureFile;

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

    /**
     * @ORM\Column(type="datetime")
     * @var null|DateTime
     */
    private $updated_at;

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

    public function setHomePicture(?string $HomePicture): self
    {
        $this->HomePicture = $HomePicture;

        return $this;
    }

    public function getHomePictureFile()
    {
        return $this->HomePictureFile;
    }

    public function setHomePictureFile( ?File $HomePictureFile ): self {
        $this->HomePictureFile = $HomePictureFile;
        if($this->HomePictureFile instanceof UploadedFile){
            $this->updated_at = new \DateTime('now');
        }
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
