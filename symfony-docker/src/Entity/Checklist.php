<?php

namespace App\Entity;

use App\Repository\ChecklistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChecklistRepository::class)]
class Checklist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'checklists')]
    private ?User $user_id = null;

    /**
     * @var Collection<int, Stepsequence>
     */
    #[ORM\ManyToMany(targetEntity: Stepsequence::class, mappedBy: 'checklists')]
    private Collection $stepsequences;

    public function __construct()
    {
        $this->stepsequences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return Collection<int, Stepsequence>
     */
    public function getStepsequences(): Collection
    {
        return $this->stepsequences;
    }

    public function addStepsequence(Stepsequence $stepsequence): static
    {
        if (!$this->stepsequences->contains($stepsequence)) {
            $this->stepsequences->add($stepsequence);
            $stepsequence->addChecklist($this);
        }

        return $this;
    }

    public function removeStepsequence(Stepsequence $stepsequence): static
    {
        if ($this->stepsequences->removeElement($stepsequence)) {
            $stepsequence->removeChecklist($this);
        }

        return $this;
    }
}
