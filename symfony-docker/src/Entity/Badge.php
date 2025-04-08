<?php

namespace App\Entity;

use App\Repository\BadgeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: BadgeRepository::class)]
class Badge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['stepsequence:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['stepsequence:read'])]
    private ?string $name = null;

    /**
     * @var Collection<int, Stepsequence>
     */
    #[ORM\OneToMany(targetEntity: Stepsequence::class, mappedBy: 'badge')]
    private Collection $stepsequences;

    public function __construct()
    {
        $this->stepsequences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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
            $stepsequence->setBadge($this);
        }

        return $this;
    }

    public function removeStepsequence(Stepsequence $stepsequence): static
    {
        if ($this->stepsequences->removeElement($stepsequence)) {
            // set the owning side to null (unless already changed)
            if ($stepsequence->getBadge() === $this) {
                $stepsequence->setBadge(null);
            }
        }

        return $this;
    }
}
