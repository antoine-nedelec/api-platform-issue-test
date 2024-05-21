<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\JoinedChild2Repository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: JoinedChild2Repository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
    ]
)]
class JoinedChild2 extends JoinedTableParent
{
    #[ORM\Column(length: 255)]
    #[Groups(groups: [
        'normalize_with_attribute_in_child',
    ])]
    private ?string $customClassOneField = null;

    public function getCustomClassOneField(): ?string
    {
        return $this->customClassOneField;
    }

    public function setCustomClassOneField(?string $customClassOneField): void
    {
        $this->customClassOneField = $customClassOneField;
    }

}
