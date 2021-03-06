<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 * @ApiResource
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read:client"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:client"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:client"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:client"})
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:client"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=25)
     * @Groups({"read:client"})
     */
    private $tel;


    /**
     * @ORM\OneToMany(targetEntity=Trajet::class, mappedBy="idClient", orphanRemoval=true)
     * @Groups({"read:client"})
     */
    private $AllTrajets;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="clients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $addedBy;

    public function __construct()
    {
        $this->AllTrajets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }


    /**
     * @return Collection|Trajet[]
     */
    public function getAllTrajets(): Collection
    {
        return $this->AllTrajets;
    }

    public function addTrajet(Trajet $trajet): self
    {
        if (!$this->AllTrajets->contains($trajet)) {
            $this->AllTrajets[] = $trajet;
            $allTrajet->setIdClient($this);
        }

        return $this;
    }

    public function removeTrajet(Trajet $trajet): self
    {
        if ($this->AllTrajets->contains($trajet)) {
            $this->AllTrajets->removeElement($trajet);
            // set the owning side to null (unless already changed)
            if ($allTrajet->getIdClient() === $this) {
                $allTrajet->setIdClient(null);
            }
        }

        return $this;
    }


    public function getAddedBy(): ?Utilisateur
    {
        return $this->addedBy;
    }

    public function setAddedBy(?Utilisateur $addedBy): self
    {
        $this->addedBy = $addedBy;

        return $this;
    }

    public function __toString()
    {
        return $this->prenom.' '.$this->nom;
    }
}
