<?php

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=FileRepository::class)
 * @Vich\Uploadable
 */
class MynewFile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Vich\UploadableField(mapping="region",fileNameProperty="imageName",size="imageZize")
     */
    private $imageFile = null;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $imageName;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $imageZize;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $updatAt;

    /**
     * @ORM\ManyToOne(targetEntity=Region::class, inversedBy="files")
     */
    private $region;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName($imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getImageZize(): ?int
    {
        return $this->imageZize;
    }

    public function setImageZize(int $imageZize): self
    {
        if($this->imageZize == null) {
            $this->imageZize = 0;
        }
        else {
            $this->imageZize = $imageZize;
        }
        return $this;
    }

    public function getUpdatAt(): ?\DateTimeInterface
    {
        return $this->updatAt;
    }

    public function setUpdatAt(\DateTimeInterface $updatAt): self
    {
        $this->updatAt = $updatAt;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;

    }

    public function __toString() {
        return $this->getImageName();
    }
}
