<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AppointementRepository;
use DateTimeImmutable;

#[ORM\Entity(repositoryClass: AppointementRepository::class)]
class Appointement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $uptdateAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateAppointment = null;

    #[ORM\ManyToOne(inversedBy: 'appointements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Medecin $medecin = null;

    #[ORM\ManyToOne(inversedBy: 'appointements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Patient $patient = null;

    public function __construct()
    {
        // Constructeur par défaut
        $this->createdAt = new DateTimeImmutable();
        $this->uptdateAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUptdateAt(): ?\DateTimeImmutable
    {
        return $this->uptdateAt;
    }

    public function setUptdateAt(\DateTimeImmutable $uptdateAt): self
    {
        $this->uptdateAt = $uptdateAt;
        return $this;
    }

    public function getDateAppointment(): ?\DateTimeInterface
    {
        return $this->dateAppointment;
    }

    public function setDateAppointment(\DateTimeInterface $dateAppointment): self
    {
        $this->dateAppointment = $dateAppointment;
        return $this;
    }

    public function getMedecin(): ?Medecin
    {
        return $this->medecin;
    }

    public function setMedecin(?Medecin $medecin): self
    {
        $this->medecin = $medecin;
        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;
        return $this;
    }
}
