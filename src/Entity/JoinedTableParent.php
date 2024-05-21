<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\JoinedTableParentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: JoinedTableParentRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
    ]
)]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'class_type', type: 'string')]
#[ORM\DiscriminatorMap(['class1' => JoinedChild1::class, 'class2' => JoinedChild2::class])]
abstract class JoinedTableParent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(groups: [
        'normalize_with_attribute_in_parent',
    ])]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: EntryPoint::class, inversedBy: "joinedTableEntities")]
    #[ORM\JoinColumn(name: 'entry_point_id', referencedColumnName: 'id', nullable: false)]
    private EntryPoint $entryPoint;

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

    public function getEntryPoint(): EntryPoint
    {
        return $this->entryPoint;
    }

    public function setEntryPoint(EntryPoint $entryPoint): void
    {
        $this->entryPoint = $entryPoint;
    }
}
