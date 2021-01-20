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
    private $FirstCategoryPicture;

    /**
     * @var File|null
     * @Assert\Image(mimeTypes={"image/jpeg", "image/jpg", "image/png"})
     * @Vich\UploadableField(mapping="upload", fileNameProperty="FirstCategoryPicture")
     *
     */
    private $FirstCategoryPictureFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SecondCategoryPicture;

    /**
     * @var File|null
     * @Assert\Image(mimeTypes={"image/jpeg", "image/jpg", "image/png"})
     * @Vich\UploadableField(mapping="upload", fileNameProperty="SecondCategoryPicture")
     *
     */
    private $SecondCategoryPictureFile;

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

    public function setHomePictureFile( ?File $HomePictureFile ): void {
        $this->HomePictureFile = $HomePictureFile;
        if($this->HomePictureFile instanceof UploadedFile){
            $this->updated_at = new \DateTime('now');
        }
        //return $this;
    }

    public function getFirstCategoryPicture(): ?string
    {
        return $this->FirstCategoryPicture;
    }

    public function setFirstCategoryPicture(?string $FirstCategoryPicture): self
    {
        $this->FirstCategoryPicture = $FirstCategoryPicture;

        return $this;
    }
    
    public function getFirstCategoryPictureFile()
    {
        return $this->FirstCategoryPictureFile;
    }

    public function setFirstCategoryPictureFile( ?File $FirstCategoryPictureFile ): void {
        $this->FirstCategoryPictureFile = $FirstCategoryPictureFile;
        if($this->FirstCategoryPictureFile instanceof UploadedFile){
            $this->updated_at = new \DateTime('now');
        }
        //return $this;
    }

    public function getSecondCategoryPicture(): ?string
    {
        return $this->SecondCategoryPicture;
    }

    public function setSecondCategoryPicture(?string $SecondCategoryPicture): self
    {
        $this->SecondCategoryPicture = $SecondCategoryPicture;

        return $this;
    }

    public function getSecondCategoryPictureFile()
    {
        return $this->SecondCategoryPictureFile;
    }

    public function setSecondCategoryPictureFile( ?File $SecondCategoryPictureFile ): void {
        $this->SecondCategoryPictureFile = $SecondCategoryPictureFile;
        if($this->SecondCategoryPictureFile instanceof UploadedFile){
            $this->updated_at = new \DateTime('now');
        }
        //return $this;
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
