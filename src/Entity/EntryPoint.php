<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Serializer\Filter\GroupFilter;
use App\Repository\EntryPointRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EntryPointRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
    ]
)]
#[ApiFilter(GroupFilter::class, arguments: ['whitelist' => [
    'normalize_with_attribute_in_parent',
    'normalize_with_attribute_in_parent_and_child',
    'normalize_with_attribute_in_child',
]])]
class EntryPoint
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(groups: [
        'normalize_with_attribute_in_parent',
        'normalize_with_attribute_in_child',
    ])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(groups: [
        'normalize_with_attribute_in_parent',
        'normalize_with_attribute_in_child',
    ])]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: JoinedTableParent::class, mappedBy: 'entryPoint')]
    #[Groups(groups: [
        'normalize_with_attribute_in_parent',
        'normalize_with_attribute_in_child',
    ])]
    private Collection $joinedTableEntities;

    public function __construct()
    {
        $this->joinedTableEntities = new ArrayCollection();
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

    public function getJoinedTableEntities(): Collection
    {
        return $this->joinedTableEntities;
    }

    public function addJoinedTableEntity(JoinedTableParent $joinedTableParent): void
    {
        if(!$this->joinedTableEntities->contains($joinedTableParent)) {
            $this->joinedTableEntities->add($joinedTableParent);
        }
    }

    public function removeJoinedTableEntity(JoinedTableParent $joinedTableParent): void
    {
        if($this->joinedTableEntities->contains($joinedTableParent)) {
            $this->joinedTableEntities->removeElement($joinedTableParent);
        }
    }
}
