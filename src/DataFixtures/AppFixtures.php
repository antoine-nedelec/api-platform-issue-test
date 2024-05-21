<?php

namespace App\DataFixtures;

use App\Entity\JoinedChild1;
use App\Entity\JoinedChild2;
use App\Entity\EntryPoint;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $entryClass = new EntryPoint();
        $entryClass->setName('entryClassName 1');

        $superClass1 = new JoinedChild1();
        $superClass1->setName('child type 1');
        $superClass1->setCustomClassTwoField('custom string 2');
        $superClass1->setEntryPoint($entryClass);

        $superClass2 = new JoinedChild2();
        $superClass2->setName('child type 2');
        $superClass2->setCustomClassOneField('custom string 1');
        $superClass2->setEntryPoint($entryClass);

        $manager->persist($superClass1);
        $manager->persist($superClass2);
        $manager->persist($entryClass);
        $manager->flush();
    }
}
