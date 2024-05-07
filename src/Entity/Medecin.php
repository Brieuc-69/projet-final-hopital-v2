<?php

namespace App\Entity;

use App\Repository\MedecinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedecinRepository::class)]
class Medecin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $experience = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $disponible = null;


    #[ORM\Column]
    private ?int $tarif = null;

    #[ORM\OneToOne(inversedBy: 'medecin', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $tel = null;

    /**
     * @var Collection<int, Experience>
     */
    #[ORM\ManyToMany(targetEntity: Experience::class, inversedBy: 'medecins')]
    private Collection $noteEtoile;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?File $url = null;

    /**
     * @var Collection<int, Appointement>
     */
    #[ORM\OneToMany(targetEntity: Appointement::class, mappedBy: 'medecin')]
    private Collection $appointements;

    public function __construct()
    {
        $this->noteEtoile = new ArrayCollection();
        $this->appointements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(string $experience): static
    {
        $this->experience = $experience;

        return $this;
    }

    public function getDisponible(): ?\DateTimeInterface
    {
        return $this->disponible;
    }

    public function setDisponible(\DateTimeInterface $disponible): static
    {
        $this->disponible = $disponible;

        return $this;
    }


    public function getTarif(): ?int
    {
        return $this->tarif;
    }

    public function setTarif(int $tarif): static
    {
        $this->tarif = $tarif;

        return $this;
    }
    
    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * @return Collection<int, Experience>
     */
    public function getNoteEtoile(): Collection
    {
        return $this->noteEtoile;
    }

    public function addNoteEtoile(Experience $noteEtoile): static
    {
        if (!$this->noteEtoile->contains($noteEtoile)) {
            $this->noteEtoile->add($noteEtoile);
        }

        return $this;
    }

    public function removeNoteEtoile(Experience $noteEtoile): static
    {
        $this->noteEtoile->removeElement($noteEtoile);

        return $this;
    }

    public function getUrl(): ?File
    {
        return $this->url;
    }

    public function setUrl(?File $url): static
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection<int, Appointement>
     */
    public function getAppointements(): Collection
    {
        return $this->appointements;
    }

    public function addAppointement(Appointement $appointement): static
    {
        if (!$this->appointements->contains($appointement)) {
            $this->appointements->add($appointement);
            $appointement->setMedecin($this);
        }

        return $this;
    }

    public function removeAppointement(Appointement $appointement): static
    {
        if ($this->appointements->removeElement($appointement)) {
            // set the owning side to null (unless already changed)
            if ($appointement->getMedecin() === $this) {
                $appointement->setMedecin(null);
            }
        }

        return $this;
    }
}
