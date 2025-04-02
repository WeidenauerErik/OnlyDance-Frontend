<?php

namespace App\Entity;

use App\Repository\StepRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StepRepository::class)]
class Step
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'howquick')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Stepsequence $stepsequence = null;

    #[ORM\Column]
    private ?int $howquick = null;

    #[ORM\Column]
    private ?float $m1_x = null;

    #[ORM\Column]
    private ?float $m1_y = null;

    #[ORM\Column]
    private ?float $m1_rotate = null;

    #[ORM\Column]
    private ?bool $m1_heel = null;

    #[ORM\Column]
    private ?bool $m1_toe = null;

    #[ORM\Column]
    private ?float $m2_x = null;

    #[ORM\Column]
    private ?float $m2_y = null;

    #[ORM\Column]
    private ?float $m2_rotate = null;

    #[ORM\Column]
    private ?bool $m2_heel = null;

    #[ORM\Column]
    private ?bool $m2_toe = null;

    #[ORM\Column]
    private ?float $w1_x = null;

    #[ORM\Column]
    private ?float $w1_y = null;

    #[ORM\Column]
    private ?float $w1_rotate = null;

    #[ORM\Column]
    private ?bool $w1_heel = null;

    #[ORM\Column]
    private ?bool $w1_toe = null;

    #[ORM\Column]
    private ?float $w2_x = null;

    #[ORM\Column]
    private ?float $w2_y = null;

    #[ORM\Column]
    private ?float $w2_rotate = null;

    #[ORM\Column]
    private ?bool $w2_heel = null;

    #[ORM\Column]
    private ?bool $w2_toe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStepsequence(): ?Stepsequence
    {
        return $this->stepsequence;
    }

    public function setStepsequence(?Stepsequence $stepsequence): static
    {
        $this->stepsequence = $stepsequence;

        return $this;
    }

    public function getHowquick(): ?int
    {
        return $this->howquick;
    }

    public function setHowquick(int $howquick): static
    {
        $this->howquick = $howquick;

        return $this;
    }

    public function getM1X(): ?float
    {
        return $this->m1_x;
    }

    public function setM1X(float $m1_x): static
    {
        $this->m1_x = $m1_x;

        return $this;
    }

    public function getM1Y(): ?float
    {
        return $this->m1_y;
    }

    public function setM1Y(float $m1_y): static
    {
        $this->m1_y = $m1_y;

        return $this;
    }

    public function getM1Rotate(): ?float
    {
        return $this->m1_rotate;
    }

    public function setM1Rotate(float $m1_rotate): static
    {
        $this->m1_rotate = $m1_rotate;

        return $this;
    }

    public function isM1Heel(): ?bool
    {
        return $this->m1_heel;
    }

    public function setM1Heel(bool $m1_heel): static
    {
        $this->m1_heel = $m1_heel;

        return $this;
    }

    public function isM1Toe(): ?bool
    {
        return $this->m1_toe;
    }

    public function setM1Toe(bool $m1_toe): static
    {
        $this->m1_toe = $m1_toe;

        return $this;
    }

    public function getM2X(): ?float
    {
        return $this->m2_x;
    }

    public function setM2X(float $m2_x): static
    {
        $this->m2_x = $m2_x;

        return $this;
    }

    public function getM2Y(): ?float
    {
        return $this->m2_y;
    }

    public function setM2Y(float $m2_y): static
    {
        $this->m2_y = $m2_y;

        return $this;
    }

    public function getM2Rotate(): ?float
    {
        return $this->m2_rotate;
    }

    public function setM2Rotate(float $m2_rotate): static
    {
        $this->m2_rotate = $m2_rotate;

        return $this;
    }

    public function isM2Heel(): ?bool
    {
        return $this->m2_heel;
    }

    public function setM2Heel(bool $m2_heel): static
    {
        $this->m2_heel = $m2_heel;

        return $this;
    }

    public function isM2Toe(): ?bool
    {
        return $this->m2_toe;
    }

    public function setM2Toe(bool $m2_toe): static
    {
        $this->m2_toe = $m2_toe;

        return $this;
    }

    public function getW1X(): ?float
    {
        return $this->w1_x;
    }

    public function setW1X(float $w1_x): static
    {
        $this->w1_x = $w1_x;

        return $this;
    }

    public function getW1Y(): ?float
    {
        return $this->w1_y;
    }

    public function setW1Y(float $w1_y): static
    {
        $this->w1_y = $w1_y;

        return $this;
    }

    public function isW1Rotate(): ?float
    {
        return $this->w1_rotate;
    }

    public function setW1Rotate(float $w1_rotate): static
    {
        $this->w1_rotate = $w1_rotate;

        return $this;
    }

    public function isW1Heel(): ?bool
    {
        return $this->w1_heel;
    }

    public function setW1Heel(bool $w1_heel): static
    {
        $this->w1_heel = $w1_heel;

        return $this;
    }

    public function isW1Toe(): ?bool
    {
        return $this->w1_toe;
    }

    public function setW1Toe(bool $w1_toe): static
    {
        $this->w1_toe = $w1_toe;

        return $this;
    }

    public function getW2X(): ?float
    {
        return $this->w2_x;
    }

    public function setW2X(float $w2_x): static
    {
        $this->w2_x = $w2_x;

        return $this;
    }

    public function getW2Y(): ?float
    {
        return $this->w2_y;
    }

    public function setW2Y(float $w2_y): static
    {
        $this->w2_y = $w2_y;

        return $this;
    }

    public function getW2Rotate(): ?float
    {
        return $this->w2_rotate;
    }

    public function setW2Rotate(float $w2_rotate): static
    {
        $this->w2_rotate = $w2_rotate;

        return $this;
    }

    public function isW2Heel(): ?bool
    {
        return $this->w2_heel;
    }

    public function setW2Heel(bool $w2_heel): static
    {
        $this->w2_heel = $w2_heel;

        return $this;
    }

    public function isW2Toe(): ?bool
    {
        return $this->w2_toe;
    }

    public function setW2Toe(bool $w2_toe): static
    {
        $this->w2_toe = $w2_toe;

        return $this;
    }
}
