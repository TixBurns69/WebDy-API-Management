<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Students
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
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Mention;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Degree;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getMention(): ?string
    {
        return $this->Mention;
    }

    public function setMention(string $Mention): self
    {
        $this->Mention = $Mention;

        return $this;
    }

    public function getDegree(): ?string
    {
        return $this->Degree;
    }

    public function setDegree(string $Degree): self
    {
        $this->Degree = $Degree;

        return $this;
    }
}
