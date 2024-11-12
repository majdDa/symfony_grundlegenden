<?php

namespace App\Entity;

use App\Repository\MyTableRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MyTableRepository::class)]
class MyTable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $Number = null;

    #[ORM\Column(length: 255)]
    private ?string $Data = null;

    #[ORM\Column(length: 255)]
    private ?string $Info= null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->Number;
    }

    public function setNumber(string $Number): static
    {
        $this->Number = $Number;

        return $this;
    }

    public function getData(): ?string
    {
        return $this->Data;
    }

    public function setData(string $Data): static
    {
        $this->Data = $Data;

        return $this;
    }


    public function getInfo(): ?string
    {
        return $this->Info;
    }

    public function setInfo(string $Info): self
    {
        $this->Info = $Info;

        return $this;
    }
}
