<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CoursRepository")
 * @Vich\Uploadable
 */
class Cours
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string|null
     */
    private $fileName;


    /**
     * @var File|null
     * @Vich\UploadableField(mapping="cours_image", fileNameProperty="filename")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $public;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $tarifs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Session", mappedBy="Cours", orphanRemoval=true)
     */
    private $sessions;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Atelier", inversedBy="relation")
     */
    private $atelier;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

 

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(?string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getPublic(): ?string
    {
        return $this->public;
    }

    public function setPublic(?string $public): self
    {
        $this->public = $public;

        return $this;
    }

    public function getTarifs(): ?string
    {
        return $this->tarifs;
    }

    public function setTarifs(?string $tarifs): self
    {
        $this->tarifs = $tarifs;

        return $this;
    }

    /**
     * @return Collection|Session[]
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions[] = $session;
            $session->setCours($this);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->sessions->contains($session)) {
            $this->sessions->removeElement($session);
            // set the owning side to null (unless already changed)
            if ($session->getCours() === $this) {
                $session->setCours(null);
            }
        }

        return $this;
    }

    public function getAtelier(): ?Atelier
    {
        return $this->atelier;
    }

    public function setAtelier(?Atelier $atelier): self
    {
        $this->atelier = $atelier;

        return $this;
    }

    public function setImageFile(?File $imageFile ): Cours
    {
        $this->imageFile = $imageFile;
        if( $this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');

        }
        

       return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setFileName(?string $fileName): Cours
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
    
    public function __toString(){
        return $this->title;
       }

 
}
