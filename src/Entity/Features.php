<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FeaturesRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=FeaturesRepository::class)
 * @Vich\Uploadable()
 */
class Features
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
     * @ORM\Column(type="text")
     */
    private $Text;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Feature_Picture;

    /**
     * @var File|null
     * @Assert\Image(mimeTypes={"image/jpeg", "image/jpg", "image/png"})
     * @Vich\UploadableField(mapping="upload", fileNameProperty="Feature_Picture")
     */
    private $Feature_PictureFile;

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

    public function getText(): ?string
    {
        return $this->Text;
    }

    public function setText(string $Text): self
    {
        $this->Text = $Text;

        return $this;
    }

    public function getFeaturePicture(): ?string
    {
        return $this->Feature_Picture;
    }

    public function setFeaturePicture(?string $Feature_Picture): self
    {
        $this->Feature_Picture = $Feature_Picture;

        return $this;
    }

    public function getFeaturePictureFile()
    {
        return $this->Feature_PictureFile;
    }

    public function setFeaturePictureFile( ?File $Feature_PictureFile ): void {
        $this->Feature_PictureFile = $Feature_PictureFile;
        if($this->Feature_PictureFile instanceof UploadedFile){
            $this->updated_at = new \DateTime('now');
        }
        //return $this;
    }
}
