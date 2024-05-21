<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\JoinedChild1Repository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: JoinedChild1Repository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
    ]
)]
class JoinedChild1 extends JoinedTableParent
{
    #[ORM\Column(length: 255)]
    #[Groups(groups: [
        'normalize_with_attribute_in_child',
    ])]
    private ?string $customClassTwoField = null;

    public function getCustomClassTwoField(): ?string
    {
        return $this->customClassTwoField;
    }

    public function setCustomClassTwoField(?string $customClassTwoField): void
    {
        $this->customClassTwoField = $customClassTwoField;
    }
}
