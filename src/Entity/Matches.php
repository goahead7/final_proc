<?php

namespace App\Entity;

use App\Repository\MatchesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatchesRepository::class)
 */
class Matches
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $command1;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $command2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $place;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCommand1(): ?string
    {
        return $this->command1;
    }

    public function setCommand1(string $command1): self
    {
        $this->command1 = $command1;

        return $this;
    }

    public function getCommand2(): ?string
    {
        return $this->command2;
    }

    public function setCommand2(string $command2): self
    {
        $this->command2 = $command2;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }
}
